<?php
require_once "db.php";

$id = $_POST['id'] ?? null; // Pastikan id telah dikirimkan melalui POST

if ($id) {
    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // Tutup koneksi database
    $stmt->close();
    $conn->close();

    // Periksa jika data ditemukan
    $nim = $data['nim'] ?? '';
    $nama = $data['nama'] ?? '';
} else {
    die("ID tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit Data</title>
</head>

<body>
    <br>
    <a href="index.php">Kembali Ke Beranda</a>
    <br>
    <h3>Edit Data</h3>
    <form action="update_data.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($nim); ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama); ?>">
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>


</body>

</html>