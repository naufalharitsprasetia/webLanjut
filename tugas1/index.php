<?php
require_once "db.php";

$sql = "SELECT * FROM mahasiswa ORDER BY id DESC LIMIT 10";

$result = $conn->query($sql) or die($conn->error);

$conn->close();
?>

<h1>Tugas 1 - Pemrogramman Web Lanjut</h1>
<p><i>Oleh : Naufal Harits Prasetia / 432022611051</i></p>

<hr>
<ul>
    <li>
        <div class="">
            <form action="search.php" method="POST">
                <!-- Dropdown untuk memilih jenis pencarian -->
                <label for="cariBerdasarkan">Cari Berdasarkan:</label>
                <select id="cariBerdasarkan" name="cariBerdasarkan" required>
                    <option value="nama">Nama</option>
                    <option value="nim">NIM</option>
                </select>

                <!-- Input teks untuk NIM atau Nama -->
                <label for="keyword">Masukkan Nama atau NIM:</label>
                <input type="text" id="keyword" name="keyword" required placeholder="Nama atau NIM">

                <!-- Tombol Submit -->
                <button type="submit">Cari</button>
            </form>
        </div>
    </li>
    <li>
        <a href="form_registrasi.php">Tambah Data</a>
    </li>
</ul>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Edit</th>
            <th>Hapus</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {


        ?>
            <tr>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td>
                    <form action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="hapus.php" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
                <td>
                    <form action="detail.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit">Detail</button>
                    </form>
                </td>
            </tr>

        <?php
        }
        ?>
    </tbody>
</table>
<br><br>