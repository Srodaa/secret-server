<?php
use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

return [
    'dbhost' => $_ENV['DB_HOST'],
    'dbport' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
    'dbusername' => $_ENV['DB_USER'],
    'dbpassword' => $_ENV['DB_PASS'],
];
