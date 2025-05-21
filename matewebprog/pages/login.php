<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = 'Hibás email vagy jelszó!';
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Belépés</title>
</head>
<body>
<h1>Belépés</h1>
<form method="POST" action="login.php">
    <label for="email">Email</label>
    <input type="email" name="email" required><br>
    <label for="password">Jelszó</label>
    <input type="password" name="password" required><br>
    <button type="submit">Bejelentkezés</button>
</form>

<?php if (isset($error)) echo "<p>$error</p>"; ?>

<p>Nem vagy még regisztrálva? <a href="register.php">Regisztrálj itt</a></p>
</body>
</html>