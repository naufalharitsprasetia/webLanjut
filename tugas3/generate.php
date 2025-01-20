<?php
require 'vendor/autoload.php';

use phpseclib3\Crypt\RSA;

try {
    // Generate 2048-bit RSA keys
    $rsa = RSA::createKey(2048);
    $privateKey = $rsa->toString('PKCS8'); // Private key in PKCS#8 format
    $publicKey = $rsa->getPublicKey()->toString('PKCS8'); // Public key in PKCS#8 format

    // Save keys to files
    if (!is_dir(__DIR__ . '/keys')) {
        mkdir(__DIR__ . '/keys', 0755, true); // Create keys directory if not exists
    }

    file_put_contents(__DIR__ . '/keys/private_key.pem', $privateKey);
    file_put_contents(__DIR__ . '/keys/public_key.pem', $publicKey);

    echo "Kunci berhasil dibuat dan disimpan ke file!\n";
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . "\n";
    exit(1);
}