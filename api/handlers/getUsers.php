<?php

use services\UserService;

require_once 'config/config.php';
require_once 'services/UserService.php';
require_once 'utilities/json.php';

$users = UserService::getUsers(0, $conn);
generateResponse(true, "Update successful.", $users);