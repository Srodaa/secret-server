<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\SecretController;
use App\Database\Database;
use App\Model\Secret;
use App\Service\SecretService;


$config = require "../config/config.php";
$db = (new Database($config))->getConnection();
$secretModel = new Secret($db);
$secretService = new SecretService($secretModel);
$controller = new SecretController($secretService);

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/secret' && $method === 'POST') {
    $controller->create();
}elseif (preg_match('#/secret/([a-zA-Z0-9]+)#', $path, $matches) && $method === 'GET') {
    $controller->getSecret(['hash' => $matches[1]]);
} else {
    return "";
}