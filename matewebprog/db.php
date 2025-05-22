<?php
$config = require 'config.php';

$host = $config['db']['host'];
$user = $config['db']['user'];
$password = $config['db']['password'];
$dbname = $config['db']['dbname'];

$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_error) {
    die("Kapcsolódási hiba: " . $mysqli->connect_error);
}

$db = $mysqli;
