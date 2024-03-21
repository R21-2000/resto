<?php

session_start();

// Check if user is logged in and is kasir
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'kasir') {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kasir Home</title>
</head>
<body>
  <h1>Kasir Home</h1>
  <a href="logout.php">Logout</a>
  <h2>Fitur:</h2>
  <ul>
    <li><a href="entri_pesanan.php">Entri Pesanan</a></li>
    <li><a href="generate_laporan.php">Generate Laporan</a></li>
  </ul>
</body>
</html>