<?php

use services\MessageService;

require_once 'config/config.php';
require_once 'services/MessageService.php';
require_once 'utilities/json.php';

$channelId = $_REQUEST["channelId"];
$userId = $_REQUEST["userId"];
$content = $_REQUEST["content"];

$success = MessageService::sendMessage($userId, $channelId, $content, $conn);
if (!$success)
    generateResponse(false, "Message was not sent.", null, 500);
generateResponse(true, "Message was sent.", null);