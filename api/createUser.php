<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    require_once 'handlers/createUser.php';
else
    http_response_code(405);
