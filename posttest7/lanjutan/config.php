<?php
$host = "localhost"; // atau "127.0.0.1"
$dbname = "dbtravel";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Uncomment ini untuk testing koneksi
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>