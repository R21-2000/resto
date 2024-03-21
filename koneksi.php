<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kasir";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Koneksi gagal :( : " . mysqli_connect_error());
}

// echo "Connected successfully"; // Optional: For debugging purposes

?>
