<?php
session_start();
$config = require 'config.php';
$page = $_GET['page'] ?? 'home';

$allowed_pages = array_keys($config['menu']);
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

include 'templates/header.php';
include "pages/{$page}.php";
include 'templates/footer.php';