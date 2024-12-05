<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Font Awesome Icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      /* Root variables */
      :root {
        --sidebar-bg-color: #ffffff; /* White background for sidebar */
        --sidebar-text-color: #343a40; /* Dark text for contrast */
        --sidebar-hover-bg: #f1f1f1; /* Lighter hover background */
        --active-link-bg: #17a2b8;
        --sidebar-collapse-width: 80px;
        --sidebar-expanded-width: 250px;
        --main-bg-gradient: #ffffff; /* White background for main content */
        --button-bg-color: #4caf50;
        --button-hover-bg: #45a049;
      }

      body {
        background: var(--main-bg-gradient);
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
      }

      /* Sidebar styling */
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
        border-right: 1px solid #ddd; /* Border for separation */
      }

      .sidebar.collapsed {
        width: var(--sidebar-collapse-width);
      }

      .sidebar .logo {
        padding: 15px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: #4caf50;
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
        background-color: var(--sidebar-hover-bg);
        color: var(--active-link-bg);
      }

      .sidebar-menu li:hover a i {
        transform: scale(1.1);
      }

      /* Main content */
      .content {
        margin-left: var(--sidebar-expanded-width);
        transition: margin-left 0.3s ease;
        padding: 20px;
      }

      .content.collapsed {
        margin-left: var(--sidebar-collapse-width);
      }

      /* Search bar styling */
      .search-bar {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        padding: 10px 15px; /* Balanced padding */
        border-radius: 25px; /* Rounded corners */
        max-width: 600px; /* Moderate max-width */
        margin: 20px auto; /* Balanced margin */
      }

      .search-bar input {
        border: none;
        outline: none;
        flex: 1;
        padding-left: 12px; /* Slightly larger padding for input */
        font-size: 1.1rem; /* Slightly larger font size */
        height: 40px; /* Comfortable height */
        background: none;
      }

      .search-bar i {
        font-size: 1.3rem; /* Adjusted icon size for balance */
        margin-right: 10px; /* Balanced icon spacing */
      }

      /* Post card */
      .post-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        max-width: 600px;
        width: 100%;
      }

      .post-card img {
        width: 100%;
        border-radius: 10px;
      }

      .post-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        gap: 10px;
      }

      .post-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
      }

      /* Flex container for posts */
      .post-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 40px;
        overflow-y: auto;
        max-height: 600px; /* Fixed height for scrolling */
      }

      .post-container .post-card {
        flex: 1;
        min-width: 280px;
      }

      /* Button section styling */
      .filter-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 20px 0;
      }

      .filter-buttons button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 1rem;
      }

      .filter-buttons button:hover {
        background-color: #45a049;
      }
      /* Like button styling */
      .like-button {
        color: black; /* Change to black for the like icon */
        cursor: pointer;
        font-size: 1.5rem;
        transition: color 0.3s ease;
      }

      .like-button.liked {
        color: #4caf50; /* Change to green when liked */
      }

      /* Comment section styling */
      .comment-section {
        margin-top: 15px;
        padding-top: 10px;
        border-top: 1px solid #ddd;
      }

      .comment-section input[type="text"] {
        width: 100%;
        padding: 10px;
        border-radius: 20px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        font-size: 1rem;
      }

      .comment-section button {
        padding: 8px 20px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 1rem;
      }

      .comment-section button:hover {
        background-color: #45a049;
      }

      .comment-list {
        margin-top: 10px;
      }

      .comment-list .comment {
        background-color: #f8f9fa;
        padding: 8px;
        border-radius: 10px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
      }

      .comment-list .comment .comment-user {
        font-weight: bold;
      }

      .comment-list .comment .comment-text {
        flex: 1;
        margin-left: 10px;
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
          <a href="history.php"><i class="fa-solid fa-clock-rotate-left"></i></i> History</a>
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

    <!-- Main content -->
    <div class="content" id="content">
      <!-- Search bar -->
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Searching" />
        <a href="#"><i class="fas fa-bell ml-3"></i></a>
        <div>
          <a href="profile.php"><i class="fas fa-user-circle ml-3"></i></a>
        </div>
      </div>

      <!-- Filter buttons (Restored) -->
      <div class="filter-buttons">
        <button>Semua</button>
        <button>Lukisan</button>
        <button>Cerpen</button>
        <button>Puisi</button>
      </div>

      <!-- Post container (Scrollable) -->
      <div class="post-container">
     


      <?php
include 'controller/db.php';

try {
    $query = "SELECT works.*, users.username 
              FROM works 
              JOIN users ON works.user_id = users.id 
              ORDER BY works.created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if data exists
    if (count($data) > 0) {
        foreach ($data as $row) {
            echo '<div class="post-card mb-4">';
            echo '<div class="post-header d-flex align-items-center mb-3">';
            echo '<i class="fas fa-user-circle fa-2x text-success"></i>';
            echo '<div class="ml-3">';
            echo '<span class="font-weight-bold">' . htmlspecialchars($row['username']) . '</span><br>';
            echo '<small class="text-muted">' . date("F j, Y, g:i a", strtotime($row['created_at'])) . '</small>';
            echo '</div>';
            echo '</div>';

            // Display media if available, otherwise show placeholder
            if (!empty($row['media_url'])) {
                echo '<img src="./controller/' . htmlspecialchars($row['media_url']) . '" alt="Post Image" class="post-image" />';
            } else {
                echo '<div class="post-image placeholder"></div>';
            }

            // Display content
            echo '<p class="post-content">' . nl2br(htmlspecialchars($row['content'])) . '</p>';

            // Actions section
            echo '<div class="post-actions d-flex justify-content-between">';
            echo '<a href="#" class="text-primary"><i class="fas fa-thumbs-up"></i> Like</a>';
            echo '<a href="#" class="text-secondary"><i class="fas fa-comment"></i> Comment</a>';
            echo '</div>';
            echo '</div>'; // Close post-card
        }
    } else {
        echo '<p class="text-center">No posts found.</p>';
    }
} catch (PDOException $e) {
    echo '<p class="text-danger text-center">Error: ' . $e->getMessage() . '</p>';
}
?>


<style>
.post-card {
  background-color: #ffffff;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 20px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.post-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.post-header {
  width: 100%;
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.post-header i {
  color: #4caf50;
  font-size: 24px;
}

.post-header .username {
  margin-left: 10px;
  font-size: 16px;
  font-weight: bold;
  color: #333;
}

.post-header .date {
  margin-left: auto;
  font-size: 12px;
  color: #888;
}

.post-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 15px;
}

.post-image.placeholder {
  background-color: #f0f0f0;
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #bbb;
}

.post-content {
  flex-grow: 1;
  text-align: center;
  color: #555;
  font-size: 14px;
  margin-bottom: 15px;
}

.post-actions {
  width: 100%;
  display: flex;
  justify-content: space-between;
}

.post-actions a {
  text-decoration: none;
  font-weight: bold;
  color: #555;
  transition: color 0.3s ease;
}

.post-actions a:hover {
  color: #007bff;
}

.post-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

</style>
      </div>
    </div>

    <!-- Bootstrap JS and Font Awesome Icons -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zyel/fh7rWmlJt1h5B3mX5Pjw5OXwhtVxwjj6tjl"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      function likePost() {
        // You can add functionality here to increase the like count
      }
    </script>

    <script>
      let likedPosts = [];

      function toggleLike(postId) {
        const likeButton = document.getElementById(`like-button-${postId}`);
        const likeCount = document.getElementById(`like-count-${postId}`);
        let currentLikes = parseInt(likeCount.innerText);

        if (likedPosts.includes(postId)) {
          // If already liked, remove like
          likedPosts = likedPosts.filter((id) => id !== postId);
          likeButton.classList.remove("liked");
          currentLikes--;
        } else {
          // If not liked, add like
          likedPosts.push(postId);
          likeButton.classList.add("liked");
          currentLikes++;
        }

        likeCount.innerText = currentLikes;
      }

      function toggleCommentSection(postId) {
        const commentSection = document.getElementById(
          `comment-section-${postId}`
        );
        commentSection.style.display =
          commentSection.style.display === "none" ? "block" : "none";
      }

      function addComment(postId) {
        const commentInput = document.getElementById(`comment-input-${postId}`);
        const commentList = document.getElementById(`comment-list-${postId}`);
        const commentText = commentInput.value.trim();

        if (commentText) {
          const commentDiv = document.createElement("div");
          commentDiv.classList.add("comment");
          commentDiv.innerHTML = `<span class="comment-user">User</span><span class="comment-text">${commentText}</span>`;
          commentList.appendChild(commentDiv);
          commentInput.value = ""; // Clear input after posting
        }
      }
    </script>
  </body>
</html>
