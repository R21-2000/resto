<?php

session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

// Process form submission to add menu
if (isset($_POST['add_menu'])) {
  $nama_menu = $_POST['nama_menu'];
  $harga = $_POST['harga'];
  $kategori = $_POST['kategori'];
  $deskripsi = $_POST['deskripsi'];
  $gambar = $_FILES['gambar']['name'];

  // Upload image if any
  if ($gambar != "") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
  } else {
    $gambar = "";
  }

  // Connect to database
  include_once 'koneksi.php';

  // Query to add menu
  $sql = "INSERT INTO menu (nama_menu, harga, kategori, deskripsi, gambar) VALUES ('$nama_menu', $harga, '$kategori', '$deskripsi', '$gambar')";
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
  <title>Entri Menu</title>
</head>
<body>
  <h1>Entri Menu</h1>
  <a href="adminhome.php">Kembali ke Admin Home</a>
  <br>
  <br>
  <h2>Tambah Menu</h2>
  <form method="post" enctype="multipart/form-data">
    <label for="nama_menu">Nama Menu:</label>
    <input type="text" id="nama_menu" name="nama_menu" required>
    <br>
    <label for="harga">Harga:</label>
    <input type="number" id="harga" name="harga" required>
    <br>
    <label for="kategori">Kategori:</label>
    <select id="kategori" name="kategori" required>
      <option value="">Pilih Kategori</option>
      <option value="Makanan">Makanan</option>
      <option value="Minuman">Minuman</option>
    </select>
    <br>
    <label for="deskripsi">Deskripsi:</label>
    <br>
    <textarea id="deskripsi" name="deskripsi" rows="4" cols="50"></textarea>
    <br>
    <label for="gambar">Gambar:</label>
    <input type="file" id="gambar" name="gambar">
    <br>
    <br>
    <button type="submit" name="add_menu">Tambah Menu</button>
  </form>
</body>
</html>