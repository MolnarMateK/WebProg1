<?php
session_start();
require_once 'db.php';

// Ha be vagy jelentkezve, akkor a session név, különben "Vendég"
$name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Vendég';
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Érvényes email címet adj meg.";
}
if ($message === '') {
    $errors[] = "Az üzenet nem lehet üres.";
}

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    header("Location: index.php?page=contact");
    exit;
}

// Üzenet mentése
$stmt = $db->prepare("INSERT INTO messages (name, email, subject, message, submitted_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("ssss", $name, $email, $subject, $message);
$stmt->execute();
$stmt->close();

$_SESSION['form_data'] = [
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message
];

header("Location: index.php?page=form");
exit;
?>
