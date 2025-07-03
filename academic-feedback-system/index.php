<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login | Academic Feedback System</title>
  <link rel="stylesheet" href="assets/styles.css?v=2">
</head>
<body>
  <div class="main-container">
    <!-- Left Image Panel -->
    <div class="photo-section">
      <img src="assets/images/login-illustration.jpg" alt="Login Illustration" />
    </div>

    <!-- Right Login Form Panel -->
    <div class="login-box">
      <form action="login.php" method="post">
        <h2>🎓 Academic Feedback Login</h2>
        <input type="text" name="username" placeholder="Enter Username" required />
        <input type="password" name="password" placeholder="Enter Password" required />
        <select name="role" required>
          <option value="student">student</option>
          <option value="faculty">faculty</option>
          <option value="admin">admin</option>
        </select>
        <button type="submit">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
