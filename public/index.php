<?php
require '../vendor/autoload.php';

use App\Database\Database;


$config = require "../config/config.php";
$db = (new Database($config))->getConnection();