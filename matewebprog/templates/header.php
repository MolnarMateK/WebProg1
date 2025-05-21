<?php
$menu = $config['menu'];
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title><?= $config['site_title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Saját CSS -->
    <link rel="stylesheet" href="/matewebprog/style.css">
</head>
<body>

<!-- Navigáció -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/matewebprog/index.php">Vaszilij EDC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php foreach ($menu as $key => $value): ?>
                    <?php if ($key === 'login' && isset($_SESSION['user_id'])) continue; ?>
                    <?php if ($key === 'logout' && !isset($_SESSION['user_id'])) continue; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/matewebprog/index.php?page=<?= $key ?>"><?= $value ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero szekció -->
<section class="hero mb-5">
    <div class="container text-center">
        <h1 class="display-4">Vaszilij EDC</h1>
        <p class="lead">A mindennapi kés- és felszerelés világának magyar közössége</p>
        <a href="#tartalom" class="btn btn-primary btn-lg">Fedezd fel</a>
    </div>
</section>

<main class="container" id="tartalom">
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="alert alert-info text-center">
            Bejelentkezett: <strong><?= $_SESSION['username'] ?></strong>
        </div>
    <?php endif; ?>
