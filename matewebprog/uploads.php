<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    die("Hozzáférés megtagadva.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $upload_dir = __DIR__ . '/uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file = $_FILES['image'];
    $target_file = $upload_dir . basename($file['name']);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($image_file_type, $allowed)) {
        $_SESSION['upload_error'] = "Csak képfájlokat tölthetsz fel (jpg, jpeg, png, gif, webp).";
    } elseif ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['upload_error'] = "A fájl túl nagy. Max 5MB lehet.";
    } elseif (!move_uploaded_file($file['tmp_name'], $target_file)) {
        $_SESSION['upload_error'] = "Hiba történt a feltöltés során.";
    }

    header("Location: index.php?page=gallery");
    exit;
}
?>
