<?php

session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // koneksi database
  include_once 'koneksi.php';

  $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  // kalau usernya sudah ada role bisa langsung ke ghome masing masing
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];

    switch ($row['role']) {
      case 'admin':
        header("Location: adminhome.php");
        exit;
      case 'waiter':
        header("Location: waiterhome.php");
        exit;
      case 'kasir':
        header("Location: kasirhome.php");
        exit;
      case 'owner':
        header("Location: ownerhome.php");
        exit;
      default:
        echo "<p style='color: red;'>Login gagal! Role tidak ditemukan.</p>";
    }
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
