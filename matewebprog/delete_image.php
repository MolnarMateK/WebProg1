<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    die("Hozzáférés megtagadva.");
}

if (isset($_GET['file'])) {
    $file = basename($_GET['file']); // csak a fájlnév, semmi könyvtár
    $filepath = __DIR__ . '/uploads/' . $file;

    if (file_exists($filepath)) {
        unlink($filepath);
        $_SESSION['delete_msg'] = "Kép törölve: $file";
    } else {
        $_SESSION['delete_msg'] = "A fájl nem található.";
    }
}

header("Location: index.php?page=gallery");
exit;
