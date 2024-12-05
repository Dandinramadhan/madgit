<?php
class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        // Mengecek apakah username sudah terdaftar
        $query = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);

        if ($query->rowCount() > 0) {
            return "Username sudah terdaftar.";
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Menyimpan user baru
        $query = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'student')");
        
        if ($query->execute([$username, $email, $hashedPassword])) {
            return "Registrasi berhasil.";
        } else {
            return "Registrasi gagal.";
        }
    }

    public function login($username, $password) {
        // Mengecek apakah pengguna dengan username tersebut ada
        $query = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);

        if ($query->rowCount() == 0) {
            return "Pengguna tidak ditemukan.";
        }

        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            // Jika password benar, set session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;

            // Mengarahkan pengguna berdasarkan role
            if ($user['role'] == 'student') {
                header("Location: ../dashboard.php");
                exit();
            } elseif ($user['role'] == 'admin') {
                header("Location: ../coba.php");
                exit();
            }
        } else {
            return "Password salah.";
        }
    }
}
?>
