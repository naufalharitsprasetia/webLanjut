<?php
require_once "db.php";

// Cek apakah form disubmit
if (isset($_POST['cariBerdasarkan']) && isset($_POST['keyword'])) {
    $cariBerdasarkan = $_POST['cariBerdasarkan'];
    $keyword = $_POST['keyword'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    if ($cariBerdasarkan == 'nama') {
        $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE nama LIKE ? LIMIT 15");
    } else {
        $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE nim LIKE ? LIMIT 15");
    }

    // Menambahkan wildcard untuk pencarian
    $keyword = "%$keyword%";
    $stmt->bind_param("s", $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa jika data ditemukan
    if ($result->num_rows > 0) {
        echo "<h3>Hasil Pencarian:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>NIM</th>
                    <th>Nama</th>
                </tr>";

        // Tampilkan data hasil pencarian
        while ($mahasiswa = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($mahasiswa['id']) . "</td>
                    <td>" . htmlspecialchars($mahasiswa['nim']) . "</td>
                    <td>" . htmlspecialchars($mahasiswa['nama']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Data tidak ditemukan.";
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Form belum disubmit.";
}

// Tutup koneksi
$conn->close();

// Tombol kembali ke beranda
echo '<br><a href="index.php"><button>Kembali ke Beranda</button></a>';
