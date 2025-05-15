<?php

namespace models;

use PDO;

class Channel
{
    public static function getChannels($serverId, $lastUpdated, $conn)
    {
        $query = "SELECT channel_id, ca.channel_category_id, channel_name, channel_category_name, channel_topic
              FROM channel ch
                  JOIN channel_category ca ON ch.channel_category_id = ca.channel_category_id
              WHERE SERVER_ID = :server_id AND EXISTS(
                  SELECT 1 FROM channel WHERE last_updated > :last_updated
              )
              ORDER BY ca.channel_category_id, ch.channel_id;";

        // Prepare the statement using PDO
        $statement = $conn->prepare($query);
        $statement->bindValue(':server_id', $serverId, PDO::PARAM_INT);
        $statement->bindValue(':last_updated', $lastUpdated, PDO::PARAM_STR);
        $statement->execute();

        // Fetch results
        $channels = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $row['channel_name'] = htmlentities($row['channel_name']);
            $channels[] = $row;
        }

        return $channels;
    }


    public static function getFirstChannelId($serverId, $conn)
    {
        $query = "SELECT channel_id 
                  FROM channel
                      JOIN channel_category ON channel.channel_category_id = channel_category.channel_category_id
                  WHERE server_id = :server_id
                  ORDER BY channel_id LIMIT 1;";

        // Prepare the statement using PDO
        $statement = $conn->prepare($query);
        $statement->bindValue(':server_id', $serverId, PDO::PARAM_INT);
        $statement->execute();

        // Fetch result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row['channel_id'] ?? null; // Handle cases where no rows are returned
    }
}
