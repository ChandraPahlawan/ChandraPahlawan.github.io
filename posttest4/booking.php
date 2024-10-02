<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'proses_form.php';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Reservasi</title>
    <link rel="stylesheet" href="./dist/css/booking.css" />
</head>
<body>
    <script>alert('ANJAY LIBURAN') </script>
    <div class="form-container">
        <h2>RESERVASI NIIII</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="telepon">Nomor Telepon:</label>
            <input type="tel" id="telepon" name="telepon" required>

            <label for="tanggal">Tanggal Pemesanan:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <input type="submit" value="Kirim Reservasi">
        </form>
    </div>
</body>
</html>

<!-- <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $telepon = $_POST["telepon"];
    $tanggal = $_POST["tanggal"];

    // Di sini Anda dapat menambahkan kode untuk menyimpan data ke database
    // Contoh:
    // $conn = new mysqli("localhost", "username", "password", "nama_database");
    // $sql = "INSERT INTO reservasi (nama, telepon, tanggal) VALUES (?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sss", $nama, $telepon, $tanggal);
    // $stmt->execute();
    // $stmt->close();
    // $conn->close();

    // Redirect kembali ke halaman sebelumnya
    echo "<script>alert('Reservasi berhasil disimpan!'); window.history.back();</script>";
    exit;
}
?> -->