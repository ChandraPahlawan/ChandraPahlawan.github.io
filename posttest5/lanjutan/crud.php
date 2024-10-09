<?php
include 'dbpelanggan.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama_pelanggan'];
    $jumlah = $_POST['jumlah_tiket'];
    $destinasi = $_POST['Destinasi'];
    $telepon = $_POST['No_Telepon'];
    $tanggal = $_POST['Tanggal_booking'];
    $email = $_POST['email'];

    if ($id) {
        $sql = "UPDATE data_pelanggan SET `nama pelanggan`='$nama', `jumlah tiket`='$jumlah', Destinasi='$destinasi', `No_Telepon`='$telepon', Tanggal booking='$tanggal', email='$email' WHERE id='$id'";

    } else {
        $sql = "INSERT INTO data_pelanggan (`nama pelanggan`, `jumlah tiket`, Destinasi, `No_Telepon`, `Tanggal booking`, email) 
        VALUES ('$nama', '$jumlah', '$destinasi', '$telepon', '$tanggal', '$email')";

    }

    if ($conn->query($sql) === TRUE) {
        echo "Record saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}




if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM data_pelanggan WHERE id='$id'");
    echo "Record deleted successfully!";
}


$result = $conn->query("SELECT * FROM data_pelanggan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../dist/css/crud.css">
    <title>Admin: Manage Pelanggan</title>
</head>
<body>

<div class="container">
    <h2>Manage Pelanggan</h2>

    <form method="POST">
        <input type="hidden" name="id" value="">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required>
        Jumlah Tiket: <input type="number" name="jumlah_tiket" required>
        Destinasi: <input type="text" name="Destinasi" required>
        No Telepon: <input type="text" name="No_Telepon" required>
        Tanggal Booking: <input type="date" name="Tanggal_booking" required>
        Email: <input type="email" name="email" required>
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
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama pelanggan'] ?></td>
            <td><?= $row['jumlah tiket'] ?></td>
            <td><?= $row['Destinasi'] ?></td>
            <td><?= $row['No_Telepon'] ?></td>
            <td><?= $row['Tanggal booking'] ?></td>
            <td><?= $row['email'] ?></td>
            <td class="actions">  
                <a href="edit.php?id=<?= $row['id'] ?>"class="edit">Edit</a>
                <a href="?delete=<?= $row['id'] ?>"class="delete">Delete</a>

            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
