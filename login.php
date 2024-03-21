<?php

session_start();

if (isset($_POST['login'])) {
    $namauser = $_POST['namauser'];

  // koneksi database
  include_once 'koneksi.php';

  $sql = "SELECT * FROM user WHERE Namauser = '$namauser'";
  $result = mysqli_query($conn, $sql);

  // kalau usernya sudah ada role bisa langsung ke home masing masing
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['namauser'] = $namauser;

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
        echo "<p style='color: red;'>Duh anda siapa ya?.</p>";
    }
  } else {
    echo "<p style='color: red;'>Typo bre</p>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial_scale=1.0">
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form method="post">
    <label for="namauser">Nama Pengguna:</label>  <input type="text" id="namauser" name="namauser" required>
    <br>
    <br>
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>