<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // A jelszó titkosítása

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        $error = 'Ez az email már regisztrálva van!';
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
</head>
<body>
<h1>Regisztráció</h1>
<form method="POST" action="register.php">
    <label for="username">Felhasználónév</label>
    <input type="text" name="username" required><br>
    <label for="email">Email</label>
    <input type="email" name="email" required><br>
    <label for="password">Jelszó</label>
    <input type="password" name="password" required><br>
    <button type="submit">Regisztráció</button>
</form>

<?php if (isset($error)) echo "<p>$error</p>"; ?>

<p>Van már fiókod? <a href="login.php">Jelentkezz be itt</a></p>
</body>
</html>