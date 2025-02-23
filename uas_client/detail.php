<?php
require_once "db.php";

// Periksa apakah form disubmit
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa jika data ditemukan
    if ($result->num_rows > 0) {
        $mahasiswa = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
    exit;
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Detail Mahasiswa</title>
</head>

<body>
    <h3>Detail Mahasiswa</h3>
    <p><strong>ID:</strong> <?= htmlspecialchars($mahasiswa['id']); ?></p>
    <p><strong>NIM:</strong> <?= htmlspecialchars($mahasiswa['nim']); ?></p>
    <p><strong>Nama:</strong> <?= htmlspecialchars($mahasiswa['nama']); ?></p>
    <br>
    <a href="index.php"><button>Kembali ke Beranda</button></a>
</body>

</html>