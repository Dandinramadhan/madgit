<?php

session_start();
require_once 'db.php';

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function editUser($userId, $username, $email, $password, $role = 'users', $photo) {
        if (empty($username) || empty($email)) {
            return "Mohon lengkapi semua data yang diperlukan.";
        }

        // Jika password diisi, hash password baru
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id = ?");
            $result = $query->execute([$username, $email, $hashedPassword, $role, $userId]);
        } else {
            $query = $this->db->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
            $result = $query->execute([$username, $email, $role, $userId]);
        }

        // Proses upload file foto
        if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'uploads/profile_pics/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileTmpPath = $photo['tmp_name'];
            $fileName = $photo['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedFileExtensions = ['jpg', 'jpeg', 'png'];

            if (in_array($fileExtension, $allowedFileExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $destPath = $targetDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $fileLocation = $destPath;
                    $query = $this->db->prepare("UPDATE users SET photo = ? WHERE id = ?");
                    $result = $query->execute([$fileLocation, $userId]);
                } else {
                    return "Terjadi kesalahan saat mengunggah gambar.";
                }
            } else {
                return "Hanya format JPG, JPEG, dan PNG yang diperbolehkan.";
            }
        }

        return $result ? "Update berhasil." : "Update gagal.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_GET['id'] ?? $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'users';
    $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;

    $userController = new UserController($db);
    $message = $userController->editUser($userId, $username, $email, $password, $role, $photo);

    if ($message === "Update berhasil.") {
        header("Location: ../profile.php");
        exit;
    } else {
        echo "<p>$message</p>";
    }
}
?>