<?php
require_once "db.php";

// Periksa apakah form disubmit
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Validasi sederhana untuk memastikan ID tidak kosong
    if (!empty($id)) {
        // Menggunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);

        // Eksekusi query dan cek hasilnya
        if ($stmt->execute()) {
            echo "Data berhasil dihapus.<br>";
        } else {
            echo "Gagal menghapus data: " . $conn->error . "<br>";
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "ID tidak ditemukan.<br>";
    }
} else {
    echo "Tidak ada data yang dikirim.<br>";
}

// Tutup koneksi
$conn->close();

// Tombol kembali ke beranda
echo '<br><a href="index.php"><button>Kembali ke Beranda</button></a>';
