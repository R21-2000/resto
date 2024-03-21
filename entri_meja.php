<?php

session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

// Process form submission to add table
if (isset($_POST['add_table'])) {
  $nama_meja = $_POST['nama_meja'];
  $kapasitas = $_POST['kapasitas'];

  // Connect to database
  include_once 'koneksi.php';

  // Query to add table
  $sql = "INSERT INTO meja (nama_meja, kapasitas) VALUES ('$nama_meja', $kapasitas)";
  mysqli_query($conn, $sql);

  // Redirect to admin home page
  header("Location: adminhome.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entri Meja</title>
</head>
<body>
  <h1>Entri Meja</h1>
  <a href="adminhome.php">Kembali ke Admin Home</a>
  <br>
  <br>
  <h2>Tambah Meja</h2>
  <form method="post">
    <label for="nama_meja">Nama Meja:</label>
    <input type="text" id="nama_meja" name="nama_meja" required>
    <br>
    <label for="kapasitas">Kapasitas:</label>
    <input type="number" id="kapasitas" name="kapasitas" required>
    <br>
    <br>
    <button type="submit" name="add_table">Tambah Meja</button>
  </form>
</body>
</html>
