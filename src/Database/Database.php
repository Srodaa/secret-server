<?php
namespace App\Database;

use PDO;

class Database {
    private $pdo;

    public function __construct($config) {
        $dsn = "mysql:host={$config['dbhost']};port={$config['dbport']};dbname={$config['dbname']};charset=utf8";
        $this->pdo = new PDO($dsn, $config['dbusername'], $config['dbpassword']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("SET time_zone = 'Europe/Budapest'");
    }

    public function getConnection() {
        return $this->pdo;
    }
}