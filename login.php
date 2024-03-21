<?php

session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
  header("Location: home.php");
  exit;
}

// Process login form submission
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to database
  include_once 'koneksi.php';

  // Query to check if user exists
  $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  // If user exists, login and redirect to home page
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $username;
    header("Location: home.php");
    exit;
  } else {
    echo "<p style='color: red;'>Login gagal! Username atau password salah.</p>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <br>
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>
