<?php
include 'dbpelanggan.php';


$id = null;
$row = null;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM data_pelanggan WHERE id='$id'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Ambil untuk diedit
    } else {
        echo "No record found!";
        exit();
    }
} else {
    echo "No ID provided!";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_pelanggan'];
    $jumlah = $_POST['jumlah_tiket'];
    $destinasi = $_POST['Destinasi'];
    $telepon = $_POST['No_Telepon'];
    $tanggal = $_POST['Tanggal_booking'];
    $email = $_POST['email'];

    // Update query
    $sql = "UPDATE data_pelanggan SET 
            `nama pelanggan`='$nama', 
            `jumlah tiket`='$jumlah', 
            Destinasi='$destinasi', 
            `No_Telepon`='$telepon', 
            `Tanggal booking`='$tanggal', 
            email='$email' 
            WHERE id='$id'";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
        header("Location: crud.php"); // Arahkan ulang setelah update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" type="text/css" href="../dist/css/crud.css">
</head>
<body>

<h2>Edit Pelanggan</h2>

<!-- Form edit-->
<form method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    Nama Pelanggan: <input type="text" name="nama_pelanggan" value="<?= $row['nama pelanggan'] ?>" required><br>
    Jumlah Tiket: <input type="number" name="jumlah_tiket" value="<?= $row['jumlah tiket'] ?>" required><br>
    Destinasi: <input type="text" name="Destinasi" value="<?= $row['Destinasi'] ?>" required><br>
    No Telepon: <input type="text" name="No_Telepon" value="<?= $row['No_Telepon'] ?>" required><br>
    Tanggal Booking: <input type="date" name="Tanggal_booking" value="<?= $row['Tanggal booking'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
    <input type="submit" value="Update">
</form>

<!-- tombol kembali -->
<a href="crud.php">Kembali</a>

</body>
</html>
