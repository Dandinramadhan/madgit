<?php
require_once 'db.php'; // koneksi database
require_once 'AuthController.php'; // memanggil AuthController

$auth = new AuthController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $message = $auth->login($username, $password);
    if ($message == "Login berhasil.") {
        // Redirect ke halaman dashboard atau home setelah login berhasil
        header('Location: ../dashboard.php');
       
        exit;
    } else {
        // Jika login gagal, tampilkan pesan kesalahan
        echo "<script>alert('$message'); window.location.href='../login.php';</script>";
    }
}