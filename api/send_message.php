<?php


use models\Message;

require_once 'config/config.php';
require_once 'utilities/json.php';
require_once 'models/Message.php';


$userId = $_SESSION["user_id"];
$channelId = 1;
$lastId = $_REQUEST["lastId"] ?? 0;
$content = $_REQUEST["content"];
$success = Message::sendMessage($userId, $channelId, $content, $conn);
if (!$success)
    generateResponse(false, "Message was not sent.", null, 500);
$messages = Message::getChannelMessages(1, $lastId, $conn);
generateResponse(true, "Message was sent.", $messages);