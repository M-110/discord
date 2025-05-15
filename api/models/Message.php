<?php

namespace models;

use PDO;

class Message
{
    public static function getChannelMessages($channelId, $lastId, PDO $conn)
    {
        $query = "SELECT 
                      m.message_id, 
                      STRFTIME('%s', m.message_timestamp) AS message_timestamp,
                      m.message_content, 
                      u.user_id, 
                      u.user_name, 
                      u.user_display_name,
                      u.user_avatar_url
                  FROM message m
                      JOIN channel c ON m.channel_id = c.channel_id
                      JOIN user u ON m.user_id = u.user_id
                  WHERE m.channel_id = :channel_id AND
                        m.message_id > :last_id
                  ORDER BY m.message_id;";

        // Prepare the statement
        $statement = $conn->prepare($query);
        $statement->bindValue(':channel_id', $channelId, PDO::PARAM_INT);
        $statement->bindValue(':last_id', $lastId, PDO::PARAM_INT);
        $statement->execute();

        // Fetch results
        $messages = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $row['message_content'] = htmlentities($row['message_content']);
            $row['user_name'] = htmlentities($row['user_name']);
            $row['user_display_name'] = htmlentities($row['user_display_name']);
            $messages[] = $row;
        }
        return $messages;
    }

    public static function sendMessage($userId, $channelId, $message, PDO $conn)
    {
        $query = "INSERT INTO message 
                  (message_timestamp, message_content, user_id, channel_id) 
                  VALUES (DATETIME('now'), :message, :user_id, :channel_id)";

        // Prepare the statement
        $statement = $conn->prepare($query);
        $statement->bindValue(':message', $message, PDO::PARAM_STR);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindValue(':channel_id', $channelId, PDO::PARAM_INT);

        return $statement->execute();
    }
}
