<?php
defined('DB_HOST')    || define('DB_HOST',    'web-development-briandempsey03-mysql-container-1');
defined('DB_NAME')    || define('DB_NAME',    'testdb');
defined('DB_USER')    || define('DB_USER',    'testuser');
defined('DB_PASS')    || define('DB_PASS',    'mysecret');
defined('DB_CHARSET') || define('DB_CHARSET', 'utf8mb4');

defined('DB_DSN') || define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET);

defined('DB_OPTIONS') || define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
]);

spl_autoload_register(function ($class) {
    $classFile = __DIR__ . '/../classes/' . $class . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});