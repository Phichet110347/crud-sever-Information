<?php
// src/app/config/db.php

$host = getenv('DB_HOST') ?: 'db';
$port = getenv('DB_PORT') ?: '3306';
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$maxRetries = 10;
$retry = 0;

do {
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        break;
    } catch (PDOException $e) {
        if ($retry >= $maxRetries) {
            error_log("DB Error: " . $e->getMessage());
            die("Database unavailable. Please try again later.");
        }
        $retry++;
        sleep(2);
    }
} while (true);
?>