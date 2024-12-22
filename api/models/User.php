<?php

namespace models;

use PDO;

class User
{
    public static function getUserId(string $username, PDO $conn)
    {
        $query = "SELECT user_id FROM user WHERE user_name = :username";
        $statement = $conn->prepare($query);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row['user_id'] ?? null;
    }

    public static function updateLastOnline($userId, PDO $conn): bool
    {
        $query = "UPDATE user 
                  SET user_last_online = DATETIME('now')
                  WHERE user_id = :user_id";
        $statement = $conn->prepare($query);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $statement->execute();
    }

    public static function getUsers($lastUpdated, PDO $conn): array
    {
        $query = "SELECT user_id,
                         user_display_name, 
                         user_name, 
                         user_avatar_url, 
                         user_last_online, 
                         user_status,
                         STRFTIME('%s', user_created_date) AS user_created_date,  
                         (user_last_online > DATETIME('now', '-10 seconds')) AS is_online
                  FROM user 
                  WHERE last_updated > :last_updated
                  OR user_last_online > DATETIME('now', '-30 seconds');";
        $statement = $conn->prepare($query);
        $statement->bindValue(':last_updated', $lastUpdated, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($userId, PDO $conn): array
    {
        $query = "SELECT user_id,
                         user_display_name, 
                         user_name, 
                         user_avatar_url, 
                         user_last_online, 
                         user_status,
                         user_created_date,
                         (user_last_online > DATETIME('now', '-10 seconds')) AS is_online
                  FROM user 
                  WHERE user_id = :user_id";
        $statement = $conn->prepare($query);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    public static function createUser($username, $displayName, PDO $conn): bool
    {
        $query = "INSERT INTO user (user_name, user_display_name, user_avatar_url) 
                  VALUES (:username, :display_name, 'images/avatar.png')";
        try {
            $statement = $conn->prepare($query);
            $statement->bindValue(':username', $username, PDO::PARAM_STR);
            $statement->bindValue(':display_name', $displayName, PDO::PARAM_STR);
            return $statement->execute();
        } catch (\Exception $e) {
            return false;
        }
    }
}
