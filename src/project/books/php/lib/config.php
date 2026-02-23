<?php
// Database credentials
$host = 'mysql-container';
$dbname = 'testdb';
$username = 'testuser';
$password = 'mysecret';

// Build the DSN
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Create PDO connection
    $db = new PDO($dsn, $username, $password);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}