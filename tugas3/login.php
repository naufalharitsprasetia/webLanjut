<?php
require 'vendor/autoload.php';

use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;

// Load private key
$privateKeyPath = './keys/private_key.pem';

if (!file_exists($privateKeyPath)) {
    die("Kunci privat tidak ditemukan. Harap jalankan generate.php terlebih dahulu.");
}

$privateKey = file_get_contents($privateKeyPath);

$key = PublicKeyLoader::loadPrivateKey(file_get_contents('./keys/private_key.pem'), $password = false);
// Periksa tipe kunci
if ($key instanceof \phpseclib3\Crypt\Common\PublicKey) {
    // echo "Ini adalah kunci publik.\n";
} elseif ($key instanceof \phpseclib3\Crypt\Common\PrivateKey) {
    // echo "Ini adalah kunci privat.\n";
}
// Validate input
$username = htmlspecialchars($_POST['username'] ?? '');
$encryptedPassword = $_POST['encryptedPassword'] ?? '';

if (empty($username) || empty($encryptedPassword)) {
    die("Username atau password tidak boleh kosong.");
}

try {
    /** @var \phpseclib3\Crypt\RSA\PrivateKey $key */
    $key = $key->withPadding(RSA::ENCRYPTION_PKCS1);
    $decryptedPassword = $key->decrypt(base64_decode($encryptedPassword));

    // echo $decryptedPassword;
    if ($decryptedPassword === false) {
        die("Gagal mendekripsi password. Pastikan formatnya benar.");
    }

    // Dummy credentials (use database in real applications)
    $storedUsername = "admin";
    $storedPassword = "12345";

    // Verify credentials
    if ($username === $storedUsername && $decryptedPassword === $storedPassword) {
        echo "Login berhasil!";
    } else {
        echo "Username atau password salah.";
    }
} catch (Exception $e) {
    echo "Terjadi kesalahan di login.php: " . $e->getMessage();
    exit(1);
}