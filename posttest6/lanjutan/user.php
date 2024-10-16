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

    
    $target_dir = "destinasi/"; 
    $gambar_name = basename($_FILES["gambar"]["name"]);
    $timestamped_name = date("Y-m-d_H.i.s") . "_" . $gambar_name;
    $target_file = $target_dir . $timestamped_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File bukan gambar.";
        $uploadOk = 0;
    }

    // max 2mb
    if ($_FILES["gambar"]["size"] > 2000000) {
        $message = "Ukuran file terlalu besar. Maksimal 2MB.";
        $uploadOk = 0;
    }

    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $message = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            
            $sql = $conn->prepare("INSERT INTO data_pelanggan (`nama pelanggan`, `jumlah tiket`, `Destinasi`, `No_Telepon`, `Tanggal booking`, `email`, `gambar`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sql->bind_param("sisssss", $nama, $jumlah, $destinasi, $telepon, $tanggal, $email, $timestamped_name); 

            if ($sql->execute()) {
                $message = "Data berhasil disimpan!";
            } else {
                $message = "Error: " . $conn->error;
            }

            $sql->close();
        } else {
            $message = "Error saat meng-upload gambar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="p.css">
    <title>Data Pelanggan</title>
</head>
<body>

<div class="container">
    <h2>Masukkan datamu</h2>

    <form method="POST" enctype="multipart/form-data">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required><br>
        Jumlah Tiket: <input type="number" name="jumlah_tiket" required><br>
        Destinasi: <input type="text" name="Destinasi" required><br>
        No Telepon: <input type="text" name="No_Telepon" required><br>
        Tanggal Booking: <input type="date" name="Tanggal_booking" required><br>
        Email: <input type="email" name="email" required><br>
        Upload Gambar Tempat yang ingin dituju: <input type="file" name="gambar" required><br><br>
        <input type="submit" value="Simpan">
    </form>

    <p><?php echo $message; ?></p>

    <button onclick="location.href='tampilan.php'">Kembali</button>
</div>

</body>
</html> 
