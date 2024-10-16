<?php
include 'dbpelanggan.php';

$id = null;
$row = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM data_pelanggan WHERE id='$id'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Ambil data untuk diedit
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

    // Proses untuk gambar
    $targetDir = "destinasi/"; 
    $fileName = $row['gambar']; // Gambar sebelumnya tetap digunakan jika tidak ada gambar baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $fileName = date("Y-m-d H.i.s") . basename($_FILES['gambar']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Batas maksimal ukuran file 
        $maxSize = 2 * 1024 * 1024; // 2MB
        if ($_FILES['gambar']['size'] > $maxSize) {
            echo "Ukuran file terlalu besar. Maksimal 2MB.";
            exit;
        }

        // Ekstensi file yang diizinkan
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($fileType, $allowedTypes)) {
            echo "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            exit;
        }

        
        if ($row['gambar'] && file_exists($targetDir . $row['gambar'])) {
            unlink($targetDir . $row['gambar']);
        }

        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
            
        } else {
            echo "Error uploading the file.";
            exit;
        }
    }

    // Update query
    $sql = "UPDATE data_pelanggan SET 
            `nama pelanggan`='$nama', 
            `jumlah tiket`='$jumlah', 
            Destinasi='$destinasi', 
            `No_Telepon`='$telepon', 
            `Tanggal booking`='$tanggal', 
            email='$email', 
            gambar='$fileName'
            WHERE id='$id'";

    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
        header("Location: crud.php");
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


<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    Nama Pelanggan: <input type="text" name="nama_pelanggan" value="<?= $row['nama pelanggan'] ?>" required><br>
    Jumlah Tiket: <input type="number" name="jumlah_tiket" value="<?= $row['jumlah tiket'] ?>" required><br>
    Destinasi: <input type="text" name="Destinasi" value="<?= $row['Destinasi'] ?>" required><br>
    No Telepon: <input type="text" name="No_Telepon" value="<?= $row['No_Telepon'] ?>" required><br>
    Tanggal Booking: <input type="date" name="Tanggal_booking" value="<?= $row['Tanggal booking'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $row['email'] ?>" required><br>

    
    Gambar: <input type="file" name="gambar" accept="image/*"><br>
    <?php if (!empty($row['gambar'])): ?>
        <img src="destinasi/<?= $row['gambar'] ?>" width="100" height="100"> 
    <?php endif; ?>

    <input type="submit" value="Update">
</form>


<a href="crud.php">Kembali</a>

</body>
</html>
