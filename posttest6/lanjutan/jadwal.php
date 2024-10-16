<?php
include 'dbpelanggan.php';

// Ambil semua data dari tabel pelanggan
$result = $conn->query("SELECT * FROM data_pelanggan");

if (!$result) {
    echo "Error retrieving data: " . $conn->error;
    exit;
}
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
    <h2>Jadwal Pelanggan</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Jumlah Tiket</th>
            <th>Destinasi</th>
            <th>No Telepon</th>
            <th>Tanggal Booking</th>
            <th>Email</th>
            <th>Gambar
                Tujuan
            </th>
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
            <td>
                <!-- Tampilkan gambar jika ada, jika tidak tampilkan pesan "Tidak ada gambar" -->
                <?php if (!empty($row['gambar'])): ?>
                    <img src="destinasi/<?= htmlspecialchars($row['gambar']) ?>" width="100" height="100">
                <?php else: ?>
                    Tidak ada gambar
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <button onclick="location.href='tampilan.php'">Kembali</button>
</div>

</body>
</html>

