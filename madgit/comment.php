
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Comments Page</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #fafafa;
        font-family: Arial, sans-serif;
      }
      .post-container {
        max-width: 600px;
        margin: 50px auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }
      .post-header {
        display: flex;
        align-items: center;
        padding: 15px;
      }
      .post-header img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-right: 10px;
      }
      .post-image {
        width: 100%;
        height: auto;
      }
      .comment-section {
        padding: 15px;
        border-top: 1px solid #eaeaea;
      }
      .comment {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }
      .comment img {
        border-radius: 50%;
        width: 30px;
        height: 30px;
        margin-right: 10px;
      }
      .comment-author {
        font-weight: bold;
        margin-right: 5px;
      }
      .comment-text {
        margin-left: 5px;
      }
      .comment-form {
        display: flex;
        align-items: center;
        margin-top: 15px;
      }
      .comment-input {
        flex-grow: 1;
        padding: 10px;
        border-radius: 20px;
        border: 1px solid #eaeaea;
        margin-right: 10px;
        background-color: #f7f7f7;
      }
      .submit-button {
        background-color: #0095f6;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="post-container">
      <!-- Post Header -->
      <div class="post-header">
        <img src="https://via.placeholder.com/40" alt="User Avatar" />
        <span>Username</span>
      </div>
      <!-- Post Image -->
      <img src="assets/img/wayang.jpg" alt="Post Image" class="post-image" />

      <!-- Comment Section -->
      <div class="comment-section">
        <div id="commentsList">
          <h4>Comments</h4>
          <!-- Comments will be dynamically populated here -->
          <?php foreach ($comments as $comment): ?>
          <div class="comment">
            <img src="https://via.placeholder.com/30" alt="Commenter Avatar" />
            <span class="comment-author"><?= htmlspecialchars($comment->user->username) ?></span>
            <span class="comment-text"><?= htmlspecialchars($comment->content) ?></span>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Comment Input Form -->
        <div class="comment-form">
          <input
            type="text"
            id="commentInput"
            class="comment-input"
            placeholder="Add a comment..."
            required
          />
          <button type="submit" class="submit-button" onclick="submitComment(<?= $work_id ?>)">
            Post
          </button>
        </div>
      </div>
    </div>

    <script>
      function submitComment(workId) {
        const commentInput = document.getElementById("commentInput");
        const commentText = commentInput.value.trim();
        
        if (commentText) {
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "/comments/store", true);
          xhr.setRequestHeader("Content-Type", "application/json");
          xhr.onload = function() {
            if (xhr.status === 200) {
              // Update comments list
              const commentsList = document.getElementById("commentsList");
              const newComment = JSON.parse(xhr.responseText);
              
              // Create a new comment element
              const commentDiv = document.createElement("div");
              commentDiv.classList.add("comment");

              commentDiv.innerHTML = `
                  <img src="https://via.placeholder.com/30" alt="Commenter Avatar">
                  <span class="comment-author">You</span>
                  <span class="comment-text">${newComment.content}</span>
              `;

              // Append the new comment to the comments list
              commentsList.appendChild(commentDiv);

              // Clear the input field
              commentInput.value = "";
            } else {
              alert("Error posting comment.");
            }
          };

          xhr.send(JSON.stringify({ content: commentText, user_id: 1, work_id: workId }));
        }
      }
    </script>
  </body>
</html>
