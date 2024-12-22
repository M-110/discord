<?php
include 'config.php';

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
        $messages = getMessages();
        generateResponse(true, "Fetched chat messages.", $messages);
        break;
    case 'POST':
        $success = sendMessage();
        $messages = getMessages();
        if ($success)
            $errorCode = "500";
        generateResponse($success, "Message was receieved.", $messages);
        break;
    default:
        break;
}

function getMessages(): array
{
    global $conn;
    $lastId = $_REQUEST["lastId"] ?? 0;
    $query = "SELECT 
                MESSAGE_ID, MESSAGE_DATETIME, MESSAGE_CONTENT, m.USER_ID, USER_NAME
              FROM 
                  MESSAGE m JOIN USER u ON m.USER_ID = u.USER_ID
              WHERE
                  MESSAGE_ID > ?
              ORDER BY
                  MESSAGE_DATETIME;";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $lastId);
    $statement->execute();
    $result = $statement->get_result();
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $row['MESSAGE_CONTENT'] = htmlentities($row['MESSAGE_CONTENT']);
        $row['USER_NAME'] = htmlentities($row['USER_NAME']);
        $messages[] = $row;
    }
    return $messages;
}

function sendMessage()
{
    global $conn;
    $message = $_POST['message'];
    $username = $_POST['userId'];
    $userId = getUserId($username);
    if (!$userId)
        return false;
    $statement = $conn->prepare("INSERT INTO MESSAGE (MESSAGE_DATETIME, MESSAGE_CONTENT, USER_ID) VALUES (NOW(), ?, ?)");
    $statement->bind_param("si", $message, $userId);
    return $statement->execute();
}

function getUserId($username) {
    global $conn;
    $statement = $conn->prepare("SELECT USER_ID FROM USER WHERE USER_NAME = ?");
    $statement->bind_param("s", $username);
    $success = $statement->execute();

    if ($success && $result = $statement->get_result())
        return $result->fetch_assoc()["USER_ID"];
}

function generateResponse($success, $message, $data = array(), $errorCode = null)
{
    if (!$success && $errorCode)
        http_response_code($errorCode);
    else
        http_response_code(200);

    $response = array(
        "success" => $success,
        "message" => $message,
        "data" => $data
    );
    if ($errorCode)
        $response["error_code"] = $errorCode;
    header('Content-Type: application/json');
    echo json_encode($response);
}
