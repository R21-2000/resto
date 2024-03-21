<?php

session_start();

// Check if user is logged in and is kasir
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'kasir') {
  header("Location: login.php");
  exit;
}

// Get all menus
include_once 'koneksi.php';
$sql_menu = "SELECT * FROM menu";
$result_menu = mysqli_query($conn, $sql_menu);
$menus = [];
while ($row = mysqli_fetch_assoc($result_menu)) {
  $menus[] = $row;
}

// Process form submission to add order
if (isset($_POST['add_order'])) {
  $nama_pelanggan = $_POST['nama_pelanggan'];
  $no_meja = $_POST['no_meja'];
  $menu = $_POST['menu'];
  $jumlah = $_POST['jumlah'];

  // Connect to database
  include_once 'koneksi.php';

  // Query to add order
  $sql = "INSERT INTO pesanan (nama_pelanggan, no_meja, menu, jumlah) VALUES ('$nama_pelanggan', $no_meja, '$menu', $jumlah)";
  mysqli_query($conn, $sql);

  // Redirect to kasir home page
  header("Location: kasirhome.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entri Pesanan</title>
</head>
<body>
  <h1>Entri Pesanan</h1>
  <a href="kasirhome.php">Kembali ke Kasir Home</a>
  <br>
  <br>
  <h2>Tambah Pesanan</h2>
  <form method="post">
    <label for="nama_pelanggan">Nama Pelanggan:</label>
    <input type="text" id="nama_pelanggan" name="nama_pelanggan" required>
    <br>
    <label for="no_meja">Nomor Meja:</label>
    <input type="number" id="no_meja" name="no_meja" required>
    <br>
    <label for="menu">Menu:</label>
    <select id="menu" name="menu" required>
      <option value="">Pilih Menu</option>
      <?php foreach ($menus as $menu): ?>
        <option value="<?php echo $menu['id']; ?>"><?php echo $menu['nama_menu']; ?></option>
      <?php endforeach; ?>
    </select>
    <br>
    <label for="jumlah">Jumlah:</label>
    <input type="number" id="jumlah" name="jumlah" required>
    <br>
    <br>
    <button type="submit" name="add_order">Tambah Pesanan</button>
  </form>
</body>
</html>
