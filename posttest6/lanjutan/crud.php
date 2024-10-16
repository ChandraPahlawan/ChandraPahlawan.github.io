<?php
include 'dbpelanggan.php';

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nama = htmlspecialchars($_POST['nama_pelanggan'], ENT_QUOTES);
    $jumlah = (int) $_POST['jumlah_tiket'];
    $destinasi = htmlspecialchars($_POST['Destinasi'], ENT_QUOTES);
    $telepon = htmlspecialchars($_POST['No_Telepon'], ENT_QUOTES);
    $tanggal = $_POST['Tanggal_booking'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
    if (!$email) {
        $message = "Email tidak valid.";
        exit;
    }

    // file upload
    $targetDir = "destinasi/";  
    $fileName = date("Y-m-d H.i.s") . "_" . basename($_FILES['gambar']['name']);  // Add timestamp to filename
    $targetFilePath = $targetDir . $fileName;

    // file size dan tipe
    $maxSize = 2 * 1024 * 1024; // 2MB
    if ($_FILES['gambar']['size'] > $maxSize) {
        $message = "Ukuran file terlalu besar. Maksimal 2MB.";
        exit;
    }

    // file yang di izinkan
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($fileType, $allowedTypes)) {
        $message = "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        exit;
    }

    
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
       
        if ($id) {
            
            $result = $conn->query("SELECT gambar FROM data_pelanggan WHERE id='$id'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $oldImage = "destinasi/" . $row['gambar'];
                
                
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            // Update 
            $sql = $conn->prepare("UPDATE data_pelanggan SET `nama pelanggan`=?, `jumlah tiket`=?, Destinasi=?, `No_Telepon`=?, `Tanggal booking`=?, email=?, gambar=? WHERE id=?");
            $sql->bind_param("sisssssi", $nama, $jumlah, $destinasi, $telepon, $tanggal, $email, $fileName, $id);
        } else {
            // Insert 
            $sql = $conn->prepare("INSERT INTO data_pelanggan (`nama pelanggan`, `jumlah tiket`, Destinasi, `No_Telepon`, `Tanggal booking`, email, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sql->bind_param("sisssss", $nama, $jumlah, $destinasi, $telepon, $tanggal, $email, $fileName);
        }

    
        if ($sql->execute()) {
            $message = "Record saved successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }

        $sql->close();
    } else {
        $message = "Error uploading the file.";
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    
    $result = $conn->query("SELECT gambar FROM data_pelanggan WHERE id='$id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambarPath = "destinasi/" . $row['gambar'];

        // Delete gambar dari directory
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Delete gambar
        }
    }

    // Delete 
    $conn->query("DELETE FROM data_pelanggan WHERE id='$id'");
    $message = "Record deleted successfully!";
}

// Fetch all data
$result = $conn->query("SELECT * FROM data_pelanggan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../dist/css/crud.css">
    <title>Manage Pelanggan</title>
</head>
<body>

<div class="container">
    <h2>Manage Pelanggan</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required><br>
        Jumlah Tiket: <input type="number" name="jumlah_tiket" required><br>
        Destinasi: <input type="text" name="Destinasi" required><br>
        No Telepon: <input type="text" name="No_Telepon" required><br>
        Tanggal Booking: <input type="date" name="Tanggal_booking" required><br>
        Email: <input type="email" name="email" required><br>
        Upload Gambar Tempat yang ingin dituju: <input type="file" name="gambar" accept="image/*" required><br><br>
        <input type="submit" value="Save">
    </form>

    <button onclick="location.href='tampilan.php'">Kembali</button>
    <button onclick="location.href='logout.php'">Logout</button>

    <h3>Data Pelanggan</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Jumlah Tiket</th>
            <th>Destinasi</th>
            <th>No Telepon</th>
            <th>Tanggal Booking</th>
            <th>Email</th>
            <th>Gambar Tujuan</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['nama pelanggan']) ?></td>
            <td><?= htmlspecialchars($row['jumlah tiket']) ?></td>
            <td><?= htmlspecialchars($row['Destinasi']) ?></td>
            <td><?= htmlspecialchars($row['No_Telepon']) ?></td>
            <td><?= htmlspecialchars($row['Tanggal booking']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><img src="destinasi/<?= htmlspecialchars($row['gambar']) ?>" width="100" height="100"></td>
            <td class="actions">  
                <a href="edit.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                <a href="?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <p><?= $message; ?></p>
</div>

</body>
</html>
