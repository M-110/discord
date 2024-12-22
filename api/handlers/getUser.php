<?php

use services\UserService;

require_once 'config/config.php';
require_once 'services/UserService.php';
require_once 'utilities/json.php';

$userId = $_REQUEST["userId"];

$user = UserService::getUser($userId, $conn);
generateResponse(true, "Update successful.", $user);