<?php

use services\UserService;

require_once 'config/config.php';
require_once 'services/UserService.php';
require_once 'utilities/json.php';

$username = $_REQUEST["username"];
$displayName = $_REQUEST["displayName"];

$success = UserService::createUser($username, $displayName, $conn);
if (!$success)
    generateResponse(false, "Error: username or display name already taken.", null);
else
    generateResponse(true, "Creation successful.", null);