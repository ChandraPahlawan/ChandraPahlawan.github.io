<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbtravel";

// buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
