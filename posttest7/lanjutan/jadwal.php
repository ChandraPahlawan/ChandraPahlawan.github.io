<?php
include 'dbpelanggan.php';

// Ambil data berdasarkan pencarian jika ada
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Buat query untuk pencarian atau ambil semua data jika tidak ada pencarian
$sql = "SELECT * FROM data_pelanggan WHERE `nama pelanggan` LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = '%' . $search . '%';
$stmt->bind_param('s', $searchParam);
$stmt->execute();
$result = $stmt->get_result();

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
    <script>
    function liveSearch() {
        var searchInput = document.getElementById("searchInput").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "yourpage.php?search=" + searchInput, true); // Ubah 'yourpage.php' ke nama file PHP saat ini
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
    <h2>Jadwal Pelanggan</h2>

    <!-- Input Search -->
    <form method="GET" id="searchForm">
        <label for="searchInput">Cari Nama Pelanggan:</label>
        <input type="text" id="searchInput" name="search" placeholder="Cari nama pelanggan..." onkeyup="liveSearch()">
    </form>

    <!-- Tabel untuk menampilkan data -->
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
            </tr>
        </thead>
        <tbody>
            <!-- Hasil dari PHP -->
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
        </tbody>
    </table>

    <button onclick="location.href='tampilan.php'">Kembali</button>
</div>

</body>
</html>
