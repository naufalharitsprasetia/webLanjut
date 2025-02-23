<?php
require_once "db.php";

// Periksa apakah form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];

    // Validasi sederhana untuk memastikan ID, NIM, dan Nama tidak kosong
    if (!empty($id) && !empty($nim) && !empty($nama)) {
        // Menggunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nim, $nama, $id);

        // Eksekusi query dan cek hasilnya
        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.<br>";
        } else {
            echo "Gagal memperbarui data: " . $conn->error . "<br>";
        }

        // Tutup statement dan koneksi
        $stmt->close();
    } else {
        echo "Harap lengkapi semua data.<br>";
    }

    // Tutup koneksi
    $conn->close();
} else {
    echo "Form belum disubmit.<br>";
}

// Tombol kembali ke beranda
echo '<br><a href="index.php"><button>Kembali ke Beranda</button></a>';
