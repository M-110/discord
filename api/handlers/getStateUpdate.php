<?php

use services\ChannelService;
use services\MessageService;
use services\ServerService;
use services\UserService;

require_once 'config/config.php';
require_once 'services/ChannelService.php';
require_once 'services/MessageService.php';
require_once 'services/ServerService.php';
require_once 'services/UserService.php';
require_once 'utilities/json.php';

$serverId = $_REQUEST["serverId"];
$channelId = $_REQUEST["channelId"];
$userId = $_REQUEST["userId"];
$lastMessageId = $_REQUEST["lastMessageId"];
$lastUpdate = $_REQUEST["lastUpdate"];

$currentTimestamp = ServerService::getCurrentTimestamp($conn);
$servers = ServerService::getServers($lastUpdate, $conn);

if ($channelId == null) {
    $channelId = ChannelService::getFirstChannelId($serverId, $conn);
}

UserService::updateLastUserActivity($userId, $conn);
$messages = MessageService::getChannelMessages($channelId, $lastMessageId, $conn);
$users = UserService::getUsers($lastUpdate, $conn);
$user = UserService::getUser($userId, $conn);
$channels = ChannelService::getChannels($serverId, $lastUpdate, $conn);
$data = [
    "messages" => $messages,
    "users" => $users,
    "user" => $user,
    "channels" => $channels,
    "servers" => $servers,
    "currentTimestamp" => $currentTimestamp,
    "channelId" => $channelId
];
generateResponse(true, "Update successful.", $data);