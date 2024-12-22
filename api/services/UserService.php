<?php

namespace services;

use models\User;

require_once 'models/User.php';

class UserService
{
    public static function getUsers($lastUpdate, $conn): array
    {
        return User::getUsers($lastUpdate, $conn);
    }

    public static function getUser($userId, $conn): array
    {
        return User::getUser($userId, $conn);
    }

    public static function updateLastUserActivity($userId, $conn): bool
    {
        return User::updateLastOnline($userId, $conn);
    }

    public static function createUser($username, $displayName, $conn): bool
    {
        return User::createUser($username, $displayName, $conn);
    }
}