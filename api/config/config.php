<?php

loadEnv(__DIR__ . '/../../.env');

$appEnv = $_ENV['APP_ENV'] ?? 'production';
$appDebug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);

$dbPath = $_ENV['DB_PATH'] ?? realpath(__DIR__ . "/../../discord.db");
if (!$dbPath || !file_exists($dbPath)) {
    if ($appDebug) {
        die("Database file not found: $dbPath");
    } else {
        error_log("Database file not found: $dbPath");
        die("Database connection failed. Check logs for details.");
    }
}

$conn = null;

try {
    $conn = new PDO("sqlite:$dbPath");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    if ($appDebug) {
        die("Database connection failed: " . $e->getMessage());
    } else {
        error_log("Database connection failed: " . $e->getMessage());
        die("Database connection failed. Check logs for details.");
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function loadEnv(string $filePath): void
{
    if (!file_exists($filePath)) {
        error_log(".env file not found at: $filePath");
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
        $_SERVER[trim($key)] = trim($value);
    }
}

function handleExceptions(Throwable $exception)
{
    global $appDebug;
    http_response_code(500);
    error_log($exception->getMessage());
    if ($appDebug) {
        echo "Error: " . $exception->getMessage();
    } else {
        echo "An unexpected error has occurred. Please check the logs.";
    }
}

set_exception_handler('handleExceptions');
