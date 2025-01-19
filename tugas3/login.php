<?php
// Muat kunci privat
$privateKey = file_get_contents('./keys/private_key.pem');

// Validasi input
$username = htmlspecialchars($_POST['username'] ?? '');
$encryptedPassword = $_POST['encryptedPassword'] ?? '';

if (empty($username) || empty($encryptedPassword)) {
    die("Username atau password tidak boleh kosong.");
}

// Dekripsi password
openssl_private_decrypt(base64_decode($encryptedPassword), $decryptedPassword, $privateKey);

// Verifikasi username dan password
$storedUsername = "admin"; // Contoh username (gunakan database di aplikasi nyata)
$storedPassword = "12345"; // Contoh password

if ($username === $storedUsername && $decryptedPassword === $storedPassword) {
    echo "Login berhasil!";
    echo "<br>";
    echo "<br>";
    echo $encryptedPassword;
    echo "<br>";
    echo $username;
    echo "<br>";
    echo $decryptedPassword;
    echo "<br>";
} else {
    echo "Username atau password salah.";
    echo "<br>";
    echo "<br>";
    echo $encryptedPassword;
    echo "<br>";
    echo $username;
    echo "<br>";
    echo $decryptedPassword;
    echo "<br>";
}