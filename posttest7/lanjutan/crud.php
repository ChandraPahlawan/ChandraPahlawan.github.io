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

    // File upload
    $targetDir = "destinasi/";  
    $fileName = date("Y-m-d H.i.s") . "_" . basename($_FILES['gambar']['name']);  
    $targetFilePath = $targetDir . $fileName;

    $maxSize = 2 * 1024 * 1024; 
    if ($_FILES['gambar']['size'] > $maxSize) {
        $message = "Ukuran file terlalu besar. Maksimal 2MB.";
        exit;
    }

    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($fileType, $allowedTypes)) {
        $message = "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        exit;
    }

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
        if ($id) {
            // Fetch old image and delete it
            $result = $conn->query("SELECT gambar FROM data_pelanggan WHERE id='$id'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $oldImage = "destinasi/" . $row['gambar'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            // Update record
            $sql = $conn->prepare("UPDATE data_pelanggan SET `nama pelanggan`=?, `jumlah tiket`=?, Destinasi=?, `No_Telepon`=?, `Tanggal booking`=?, email=?, gambar=? WHERE id=?");
            $sql->bind_param("sisssssi", $nama, $jumlah, $destinasi, $telepon, $tanggal, $email, $fileName, $id);
        } else {
            // Insert new record
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

    // Fetch image and delete from folder
    $result = $conn->query("SELECT gambar FROM data_pelanggan WHERE id='$id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambarPath = "destinasi/" . $row['gambar'];
        if (file_exists($gambarPath)) {
            unlink($gambarPath); 
        }
    }

    // Delete record from database
    $conn->query("DELETE FROM data_pelanggan WHERE id='$id'");
    $message = "Record deleted successfully!";
}

// Search and fetch data
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = "SELECT * FROM data_pelanggan WHERE `nama pelanggan` LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = '%' . $search . '%';
$stmt->bind_param('s', $searchParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../dist/css/crud.css">
    <title>Manage Pelanggan</title>
    <script>
    function liveSearch() {
        var searchInput = document.getElementById("searchInput").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "yourpage.php?search=" + searchInput, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.querySelector("table tbody").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
    </script>
</head>
<body>

<div class="container">
    <h2>Manage Pelanggan</h2>

    <!-- Add Search Input Field -->
    <form method="GET" id="searchForm">
        Search Pelanggan: <input type="text" id="searchInput" name="search" placeholder="Search..." onkeyup="liveSearch()">
    </form>

    <!-- Form to Add or Edit Data -->
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

    <!-- Display Data with Search Results -->
    <h3>Data Pelanggan</h3>
    <table>
        <thead>
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
        </thead>
        <tbody>
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
        </tbody>
    </table>

    <p><?= $message; ?></p>
</div>

</body>
</html>
