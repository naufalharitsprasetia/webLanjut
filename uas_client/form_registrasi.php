<!DOCTYPE html>
<html lang="id">

<head>
    <title>Tambah Mahasiswa</title>
</head>

<body>
    <h3>Tambah Mahasiswa</h3>

    <?php
	// Cek jika ada pesan error di query string
	if (isset($_GET['error'])) {
		echo "<p>" . htmlspecialchars($_GET['error']) . "</p>";
	}

	// Cek jika ada pesan sukses di query string
	if (isset($_GET['message'])) {
		echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
	}
	?>

    <form action="proses.php" method="POST">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <button type="submit">Tambah</button>
    </form>

    <br>
    <!-- Tombol Kembali -->
    <a href="index.php"><button>Kembali ke Beranda</button></a>
</body>

</html>