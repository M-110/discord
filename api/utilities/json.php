<?php

function generateResponse($success, $message, $data = null, $errorCode = null)
{
    if (!$success && $errorCode)
        http_response_code($errorCode);
    else if (!$success)
        http_response_code(200);
    else
        http_response_code(200);
    $response = [
        "success" => $success,
        "message" => $message,
        "data" => $data,
        "errorCode" => $errorCode
    ];
    if ($errorCode)
        $response["error_code"] = $errorCode;
    header('Content-Type: application/json');
    echo json_encode($response);
}