<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php'; // Az adatbázis kapcsolódás

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ellenőrizzük, hogy az email és jelszó helyes-e
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Bejelentkezés sikeres
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Visszairányít a főoldalra
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

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<p>Nem vagy még regisztrálva? <a href="register.php">Regisztrálj itt</a></p>
</body>
</html>
