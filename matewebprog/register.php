<?php
require 'db.php'; // Az adatbázis kapcsolódás

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // A jelszó titkosítása

    // Ellenőrizzük, hogy az email már regisztrált-e
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $error = 'Ez az email már regisztrálva van!';
    } else {
        // Új felhasználó regisztrálása
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

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

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<p>Van már fiókod? <a href="login.php">Jelentkezz be itt</a></p>
</body>
</html>
