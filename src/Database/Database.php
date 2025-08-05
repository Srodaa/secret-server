<?php
namespace App\Database;

use PDO;

class Database {
    private $pdo;

    public function __construct($config) {
        $dsn = "mysql:host={$config['dbhost']};port={$config['dbport']};dbname={$config['dbname']};charset=utf8";
        $options = [
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            PDO::MYSQL_ATTR_SSL_CA => '/path/to/ca.pem',
        ];
        $this->pdo = new PDO($dsn, $config['dbusername'], $config['dbpassword'], $options);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        echo "Connected successfully";
        return $this->pdo;
    }
}