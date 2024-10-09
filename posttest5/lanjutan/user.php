<?php
include 'dbpelanggan.php'; 

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_pelanggan'];
    $jumlah = $_POST['jumlah_tiket'];
    $destinasi = $_POST['Destinasi'];
    $telepon = $_POST['No_Telepon'];
    $tanggal = $_POST['Tanggal_booking'];
    $email = $_POST['email'];

    $sql = "INSERT INTO data_pelanggan (`nama pelanggan`, `jumlah tiket`, Destinasi, `No_Telepon`, `Tanggal booking`, email) 
            VALUES ('$nama', '$jumlah', '$destinasi', '$telepon', '$tanggal', '$email')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data berhasil disimpan!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="p.css">
    <title>User: Input Data Pelanggan</title>
</head>
<body>

<div class="container">
    <h2>Masukkan datamu</h2>

    <form method="POST">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required>
        Jumlah Tiket: <input type="number" name="jumlah_tiket" required>
        Destinasi: <input type="text" name="Destinasi" required>
        No Telepon: <input type="text" name="No_Telepon" required>
        Tanggal Booking: <input type="date" name="Tanggal_booking" required>
        Email: <input type="email" name="email" required>
        <input type="submit" value="Simpan">
    </form>

    <p><?php echo $message; ?></p>

    <button onclick="location.href='tampilan.php'">Kembali</button>
</div>

</body>
</html>
