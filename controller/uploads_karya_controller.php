<?php
session_start();
require_once './db.php';

class KaryaController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addKarya($category, $title, $content, $media_url, $userId) {
        if (empty($category) || empty($title) || empty($content) || empty($media_url)) {
            return "Mohon lengkapi semua data yang diperlukan.";
        }

        try {
            $query = $this->db->prepare(
                "INSERT INTO works (category, title, content, media_url, user_id) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            $result = $query->execute([$category, $title, $content, $media_url, $userId]);

            if ($result) {
                return "Karya berhasil ditambahkan.";
            } else {
                $errorInfo = $query->errorInfo();
                return "Gagal menambahkan karya: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            return "Kesalahan database: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? null;
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;
    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        $_SESSION['error'] = 'Anda harus login terlebih dahulu.';
        header("Location: ../login.php");
        exit;
    }

    $dest_path = '';

    if (isset($_FILES['media_url']) && $_FILES['media_url']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['media_url']['tmp_name'];
        $fileName = $_FILES['media_url']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'mp4', 'avi', 'mov', 'wmv'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'uploads/karya/';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                $_SESSION['error'] = 'Terjadi kesalahan saat mengunggah file.';
                header("Location: ../dashboard.php");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Ekstensi file tidak diizinkan.';
            header("Location: ../dashboard.php");
            exit;
        }
    } else {
        $_SESSION['error'] = 'Tidak ada file yang diunggah atau terjadi kesalahan.';
        header("Location: ../dashboard.php");
        exit;
    }

    $karyaController = new KaryaController($db);
    $message = $karyaController->addKarya($category, $title, $content, $dest_path, $userId);

    $_SESSION['message'] = $message;
    header("Location: ../dashboard.php");
    exit;
}
?>
