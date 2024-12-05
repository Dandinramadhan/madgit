<?php
session_start(); // Memulai sesi

// Menghapus semua data sesi
session_unset();
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: ../login.php");
exit;
?>
