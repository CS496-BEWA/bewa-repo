<?php
require('vendor/autoload.php');

use Dcblogdev\PdoWrapper\Database;

$options = [
    'host' => "localhost",
    'database' => "496",
    'username' => "root",
    'password' => ""
];
$db = new Database($options);

$dir = "./";
