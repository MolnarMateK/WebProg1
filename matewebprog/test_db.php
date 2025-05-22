<?php
$mysqli = new mysqli('localhost', 'mateadatb', 'M8i7S6i5', 'mateadatb');

if ($mysqli->connect_error) {
    die('Sikertelen kapcsolat: ' . $mysqli->connect_error);
} else {
    echo 'Sikeres kapcsolat!';
}