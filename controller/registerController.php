<?php
require_once 'db.php'; // koneksi database
require_once 'AuthController.php'; // memanggil AuthController

$auth = new AuthController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $message = $auth->register($username, $email, $password);

    if ($message == "Registrasi berhasil.") {
        // Redirect ke halaman login setelah registrasi berhasil tanpa alert
        header('Location: ../login.php');
        exit(); // Pastikan script berhenti setelah redirect
    } else {
        // Jika registrasi gagal, tampilkan pesan kesalahan
        echo "<script>
                alert('$message');
                window.location.href = '../register.php';
            </script>";
    }
}
?>