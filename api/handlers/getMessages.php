<?php

use services\MessageService;
use services\UserService;

require_once 'config/config.php';
require_once 'services/MessageService.php';
require_once 'services/UserService.php';
require_once 'utilities/json.php';

$userId = $_SESSION["user_id"];
$channelId = 1;
$lastId = $_REQUEST["lastId"] ?? 0;

$messages = MessageService::getChannelMessages(1, $lastId, $conn);
UserService::updateLastUserActivity($userId, $conn);
generateResponse(true, "Messages were received.", $messages);