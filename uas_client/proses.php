<?php
require_once "db.php";

// Inisialisasi variabel untuk menyimpan pesan
$message = '';
$error = '';

// Periksa apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Ambil data dari form
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];

	// Validasi sederhana untuk memastikan NIM dan Nama tidak kosong
	if (!empty($nim) && !empty($nama)) {
		$sql = "INSERT INTO mahasiswa (nim, nama) VALUES (?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $nim, $nama);

		if ($stmt->execute()) {
			// Set pesan sukses
			$message = "Data telah ditambah.";
		} else {
			// Set pesan error
			$error = "Error: " . $stmt->error;
		}

		$stmt->close();
	} else {
		// Set pesan error jika data kosong
		$error = "Harap lengkapi semua data.";
	}
}

// Tutup koneksi
$conn->close();

// Menampilkan pesan sukses atau error
if ($message) {
	echo "<p>$message</p>";
	echo '<br><a href="index.php"><button>Kembali ke Beranda</button></a>';
}

if ($error) {
	echo "<p>$error</p>";
	echo '<br><a href="index.php"><button>Kembali ke Beranda</button></a>';
}
