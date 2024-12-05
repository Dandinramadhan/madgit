<?php
// submit_comment.php
require '../config/conn.php'; // Mengimpor koneksi database

// Ambil data dari permintaan POST
$content = isset($_POST['content']) ? $_POST['content'] : '';
$work_id = isset($_POST['work_id']) ? $_POST['work_id'] : '';
$user_id = 1; // Ganti dengan ID pengguna yang sedang login

if (!empty($content) && !empty($work_id)) {
    // Siapkan dan ikuti pernyataan untuk mencegah SQL Injection
    $sql = "INSERT INTO comments (user_id, work_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $work_id, $content);

    if ($stmt->execute()) {
        echo "Comment added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Content and work ID are required.";
}

$conn->close();
?>
