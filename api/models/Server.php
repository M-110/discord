<?php

namespace models;

use PDO;

class Server
{
    public static function getServers($lastUpdated, PDO $conn)
    {
        // Update SQL query for SQLite
        $query = "SELECT server_id, server_name, server_icon_url 
                  FROM server 
                  WHERE EXISTS(SELECT 1 FROM server WHERE last_updated > :last_updated);";

        // Prepare and execute the query
        $statement = $conn->prepare($query);
        $statement->bindValue(':last_updated', $lastUpdated, PDO::PARAM_STR);
        $statement->execute();

        // Fetch results
        $servers = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $row['server_name'] = htmlentities($row['server_name']);
            $servers[] = $row;
        }

        return $servers;
    }

    public static function getCurrentTimestamp(PDO $conn)
    {
        // SQLite supports CURRENT_TIMESTAMP natively
        $statement = $conn->query("SELECT CURRENT_TIMESTAMP AS current_time");
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row['current_time'] ?? null; // Return the current timestamp
    }
}
