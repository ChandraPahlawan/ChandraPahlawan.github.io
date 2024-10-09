<?php
include 'dbpelanggan.php';


$result = $conn->query("SELECT * FROM data_pelanggan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="p.css">
    <title>Lihat Jadwal</title>
</head>
<body>

<div class="container">
    <h2>jadwal lekku</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Jumlah Tiket</th>
            <th>Destinasi</th>
            <th>No Telepon</th>
            <th>Tanggal Booking</th>
            <th>Email</th>
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
        </tr>
        <?php endwhile; ?>
    </table>

    <button onclick="location.href='tampilan.php'">Kembali</button>
</div>

</body>
</html>
