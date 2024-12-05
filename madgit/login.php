



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      /* General styles for the body and background */
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    background: #f3f3f3;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  /* Container for login and image */
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
  }
  
  /* Box styling for the login form and image */
  .login-box {
    display: flex;
    flex-direction: row;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Ensure that image and form are clipped inside box */
    max-width: 900px;
    width: 100%;
  }
  
  /* Styling for the image section */
  .login-image {
    width: 50%;
  }
  
  .login-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Make sure the image covers the entire space */
  }
  
  /* Styling for the form section */
  .login-form {
    width: 50%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #fff;
  }
  
  /* Title (Login) styling */
  .login-form h2 {
    color: #333;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 30px;
    text-align: center;
  }
  
  /* Input box styles */
  .input-box {
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    border-radius: 10px;
    padding: 10px;
  }
  
  .input-box input {
    width: 100%;
    background: transparent;
    border: none;
    color: #333;
    font-size: 16px;
    outline: none;
    padding: 5px 10px;
  }
  
  /* Placeholder styling for inputs */
  input::placeholder {
    color: #aaa;
  }
  
  /* Sign up link styling */
  .text-box p {
    color: #333;
  }
  
  .text-box a {
    color: #f05c5c;
    text-decoration: none;
  }
  
  .text-box a:hover {
    text-decoration: underline;
  }
  
  /* Custom button styles */
  .btn-custom {
    background-color: #009975;
    border: none;
    border-radius: 10px;
    padding: 10px;
    width: 100%;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    transition: background 0.3s ease;
  }
  
  .btn-custom:hover {
    background-color: #008764;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  }
  
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-box">
        <div class="login-image">
          <img src="assets/img/moto.png" alt="Student creativity image" />
        </div>
        <div class="login-form">
          <h2>Welcome to Madgit</h2>




          <form action="controller/logincontroller.php" method="POST">
            <!-- Email Input -->
            <div class="input-box">
              <div class="icon-box">
                <i class="fas fa-user"></i>
              </div>
              <input type="input" name="username" placeholder="Username" required />
            </div>

            <!-- Password Input -->
            <div class="input-box">
              <div class="icon-box">
                <i class="fas fa-lock"></i>
              </div>
              <input type="password" name="password" placeholder="Password" required />
            </div>

            <!-- Sign up link -->
            <div class="text-box">
              <p>Don’t have an account? <a href="register.php">Sign up</a></p>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-custom">Login</button>
          </form>




        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
