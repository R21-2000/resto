<?php

session_start();

// Check if user is logged in and is one of waiter, kasir, or owner
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['waiter', 'kasir', 'owner'])) {
  header("Location: login.php");
  exit;
}

// Get start and end date from GET parameters
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : "";
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : "";

// Connect to database
include_once 'koneksi.php';

// Query to get all orders within the date range
$sql = "SELECT * FROM pesanan WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate Laporan</title>
</head>
<body>
  <h1>Generate Laporan</h1>
  <a href="kasirhome.php">Kembali ke Kasir Home</a>
  <br>
  <br>
  <h2>Formulir Generate Laporan</h2>
  <form method="get">
    <label for="start_date">Tanggal Mulai:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
    <br>
    <label for="end_date">Tanggal Selesai:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
    <br>
    <br>
    <button type="submit">Generate Laporan</button>
  </form>
  <br>
  <br>
  <h2>Laporan Penjualan</h2>
  <table>
    <tr>
      <th>Tanggal</th>
      <th>Nama Pelanggan</th>
      <th>Nomor Meja</th>
      <th>Menu</th>
      <th>Jumlah</th>
      <th>Total</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      $total = $row['jumlah'] * $row['harga'];
      echo "<tr>
              <td>{$row['tanggal']}</td>
              <td>{$row['nama_pelanggan']}</td>
              <td>{$row['no_meja']}</td>
              <td>{$row['menu']}</td>
              <td>{$row['jumlah']}</td>
              <td>Rp {$total}</td>
            </tr>";
    }
    ?>
  </table>
</body>
</html>
