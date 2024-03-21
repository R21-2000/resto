<?php

session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Home</title>
</head>
<body>
  <h1>Admin Home</h1>
  <a href="logout.php">Logout</a>
  <h2>Fitur:</h2>
  <ul>
    <li><a href="entri_meja.php">Entri Meja</a></li>
    <li><a href="entri_menu.php">Entri Menu</a></li>
  </ul>
</body>
</html>
