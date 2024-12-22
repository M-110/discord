<?php

namespace services;

use models\Message;

require_once 'models/Message.php';

class MessageService
{
    public static function sendMessage($userId, $channelId, $content, $conn): bool
    {
        return Message::SendMessage($userId, $channelId, $content, $conn);
    }

    public static function getChannelMessages($channelId, $lastId, $conn): array
    {
        return Message::getChannelMessages($channelId, $lastId, $conn);
    }
}