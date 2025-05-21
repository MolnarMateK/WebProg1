<?php
session_start();
session_unset(); // Kiemeli a session változókat
session_destroy(); // Megsemmisíti a session-t
header("Location: index.php"); // Visszairányít a főoldalra
exit;
?>