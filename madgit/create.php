<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Post - Madgit Mading Digital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
 :root {
            --primary-color: #e94560; /* Main color */
            --hover-color: #ff4b5c; /* Hover color */
            --bg-color: #f5f5f5; /* Background color */
            --sidebar-bg-color: #ffffff; /* Sidebar background */
            --sidebar-text-color: #000; /* Sidebar text */
            --input-border-color: #e94560; /* Input border color */
            --focus-shadow: rgba(233, 69, 96, 0.5); /* Focus shadow color */
        }

  /* Body Styling */
  body {
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-color);
            margin-left: 250px;
        }


/* Sidebar Styling */
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


  /* Container for Upload Form */
  .upload-container {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .upload-container:hover {
            transform: scale(1.02);
        }

        /* Heading Styling */
        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 25px;
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px var(--focus-shadow);
        }

        /* Button Styling */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--hover-color);
        }

        /* Image Preview Styling */
        #imagePreview img {
            max-height: 200px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        #imagePreview img:hover {
            transform: scale(1.05);
        }

        .text-center {
            margin-top: 10px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .upload-container {
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }


</style>
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


    <!-- Main Content -->
    <div class="container-fluid p-4">
        <div class="upload-container">
            <h2>Create a New Post</h2>
            <form action="./controller/uploads_karya_controller.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                        <label for="kategori" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option selected disabled>Pilih Kategori</option>
                           
                                <option value="informasi/berita">Informasi / Berita</option>
                            
                            <option value="video kreatif">Video Kreatif</option>
                            <option value="puisi">Puisi</option>
                            <option value="poster">Poster</option>
                        </select>
                    </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="content" rows="4" placeholder="Write something..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" name="media_url" id="image" accept="image/*" required>
                </div>

                <div id="imagePreview" class="text-center mt-4 mb-4 ">
                    <img src="" alt="Preview" class="img-fluid rounded" style="display: none;">
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for Image Preview
        function previewImage() {
            const fileInput = document.getElementById('image');
            const previewContainer = document.getElementById('imagePreview');
            const previewImage = previewContainer.querySelector('img');

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.setAttribute('src', e.target.result);
                    previewImage.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.setAttribute('src', '');
                previewImage.style.display = 'none';
            }
        }

        // Form validation before submission
        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();

            if (title === '' || description === '') {
                alert('Please fill in all fields.');
            } else {
                alert('Post uploaded successfully!');
                this.reset();
                document.getElementById('imagePreview').querySelector('img').style.display = 'none';
            }
        });
    </script>
</body>
</html>
