<?php
try {
    // Konfigurasi koneksi database, sesuaikan dengan setup lokal kamu
    $db = new PDO('mysql:host=localhost;dbname=madgit', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
}
?>