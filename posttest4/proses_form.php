<?php
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
    
    // Untuk sementara, kita anggap reservasi selalu berhasil
    $pesan = "Reservasi berhasil disimpan!";
    // redirec ke index.php dengan pesan
    echo "<script>
        alert('$pesan');
        window.location.href = 'index.php';
    </script>";
    exit;
} else {
    // Jika halaman diakses langsung tanpa melalui form
    header("Location: booking.php");
    exit;
}
    
?>


