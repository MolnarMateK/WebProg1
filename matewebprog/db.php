<?php
// session_start(); -> ha máshol már el van indítva, ez itt ne kelljen!

$config = require 'config.php';

$mysqli = new mysqli(
    $config['db']['host'],
    $config['db']['user'],
    $config['db']['password'],
    $config['db']['dbname']
);

if ($mysqli->connect_error) {
    die("Kapcsolódási hiba: " . $mysqli->connect_error);
}

$db = $mysqli;
?>
