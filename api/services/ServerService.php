<?php

namespace services;

use models\Server;

require_once 'models/Server.php';

class ServerService
{
    public static function getServers($lastUpdated, $conn)
    {
        return Server::getServers($lastUpdated, $conn);
    }

    public static function getCurrentTimestamp($conn)
    {
        return Server::getCurrentTimestamp($conn);
    }
}