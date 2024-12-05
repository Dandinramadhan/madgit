<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>

          <?php

      session_start();

      if (!isset($_SESSION['username'])) {
          header("Location: ../login.php");
          exit;
      }

      if (isset($_SESSION['user_id'])) {
          $userId = $_SESSION['user_id'];
      }




      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Pragma: no-cache");
      header("Expires: 0");

      $role = $_SESSION['role'];


      $_SESSION['id'] = $userId; 
      ?> 




      <?php
      include './controller/db.php';

      try {
          
          $userId = $_SESSION['id']; 

          
          $query = "SELECT username, email, role FROM users WHERE id = :id";
          $stmt = $db->prepare($query);
          $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
          $stmt->execute();

          
          $datausernamerole = $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
          exit;
      }
      ?>      


    <?php
    include './controller/db.php';
    try {
        
        $userId = $_SESSION['user_id']; 

        $query = "SELECT photo FROM users WHERE id = :user_id LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
    ?>


    <style>
      :root {
        --sidebar-width: 250px; /* Sidebar width */
        --sidebar-bg-color: #fff;
        --sidebar-text-color: #333;
        --main-bg-gradient: linear-gradient(120deg, #ffd89b, #f489cc);
      }

      /* Sidebar styling */
      :root {
  --sidebar-expanded-width: 250px; /* Ukuran sidebar tetap */
  --sidebar-collapse-width: 80px;
  --sidebar-bg-color: #ffffff; /* Background sidebar putih */
  --sidebar-text-color: #000000; /* Teks sidebar hitam */
  --sidebar-hover-bg: #f0f0f0; /* Warna hover */
  --active-link-bg: #000000; /* Warna teks aktif tetap hitam */
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: var(--sidebar-expanded-width);
  height: 100%;
  background-color: var(--sidebar-bg-color);
  color: var(--sidebar-text-color);
  transition: width 0.3s ease;
  z-index: 10;
  border-right: 1px solid #ddd; /* Border untuk pemisah */
}

.sidebar.collapsed {
  width: var(--sidebar-collapse-width);
}

.sidebar .logo {
  padding: 15px;
  text-align: center;
  font-size: 1.5rem;
  font-weight: bold;
  color: #4caf50; /* Logo 'Madgit' hijau */
}

.sidebar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-menu li {
  padding: 12px 20px;
  transition: all 0.3s ease;
}

.sidebar-menu li a {
  text-decoration: none;
  color: var(--sidebar-text-color);
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1.1rem;
  padding: 10px;
  border-radius: 30px;
  transition: all 0.3s ease;
}

.sidebar-menu li a i {
  font-size: 1.3rem;
  transition: transform 0.3s ease;
}

.sidebar-menu li:hover,
.sidebar-menu li.active {
  background-color: var(--sidebar-hover-bg); /* Warna hover */
}

.sidebar-menu li:hover a i {
  transform: scale(1.1); /* Efek zoom ikon */
}

      /* Profile Content styling with animation */
      .profile-content {
        margin-left: var(--sidebar-width);
        padding: 60px 50px;
        background: var(--main-bg-gradient);
        min-height: 100vh;
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        opacity: 0;
        animation: fadeIn 1s forwards; /* Fade-in animation */
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      .profile-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        width: 100%;
        max-width: 800px;
        margin-bottom: 40px;
      }

      .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #333;
        position: relative;
        flex-shrink: 0;
        transition: transform 0.3s ease; /* Hover scale effect */
      }

      .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .profile-avatar:hover {
        transform: scale(1.1); /* Slightly scale the image */
      }

      .upload-btn-wrapper {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 5px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.3s ease;
      }

      .upload-btn-wrapper:hover {
        transform: scale(1.2); /* Grow the upload button */
      }

      .upload-btn-wrapper input[type="file"] {
        display: none;
      }

      .profile-info {
        font-size: 1.2rem;
        text-align: center;
      }

      .profile-info h2 {
        margin: 0;
        font-size: 1.8rem;
      }

      .profile-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
      }

      .profile-buttons button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
        font-size: 1rem;
      }

      .profile-buttons button:hover {
        background-color: #555;
        transform: scale(1.1); /* Scale button on hover */
      }
        .sidebar .logo {
    padding: 15px;
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: #4caf50; /* Logo 'Madgit' hijau */
  }
    </style>
</head>
<body>

     <!-- Sidebar -->
     <div class="sidebar" id="sidebar">
  <div class="logo">Madgit</div>
  <ul class="sidebar-menu">
    <li>
      <a href="dashboard.php"><i class="fa-solid fa-house"></i> Beranda</a>
    </li>
    <li>
      <a href="history.php"><i class="fa-solid fa-clock-rotate-left"></i> History</a>
    </li>
    <li>
      <a href="create.php"><i class="fa-solid fa-plus"></i> Create</a>
    </li>
    <li>
      <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
    </li>
    <li>
      <a href="controller/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </li>
  </ul>
</div>

    <!-- Profile Content -->
    <div class="profile-content">
      <div class="profile-header">
        <!-- Foto Profil dengan Upload -->
        <div class="profile-avatar">
          <img id="profileImage" src="<?php echo !empty($data['photo']) 
                ? './controller/' . htmlspecialchars($data['photo']) 
                : './controller/default.jpg'; ?>" alt="Profile Avatar">
          <div class="upload-btn-wrapper">
            
           
          </div>
        </div>
      </div>

      <!-- Informasi Profil dan Tombol -->
      <div class="profile-info">
        <h2><?php echo ($datausernamerole['username'])?></h2>
        <span><?php echo ($datausernamerole['email'])?></span>
      </div>
      <div class="profile-buttons">
        <a href="edit_profile.php?id=<?php echo $_SESSION['user_id']; ?>"><button>Setting</button></a>
      </div>
    </div>

    
</body>
</html>
