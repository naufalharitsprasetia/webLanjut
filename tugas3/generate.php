<?php
// Konfigurasi pasangan kunci RSA
$config = [
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
];

$keyPair = openssl_pkey_new($config);
if (!$keyPair) {
    die("Error: " . openssl_error_string());
}

openssl_pkey_export($keyPair, $privateKey);
$keyDetails = openssl_pkey_get_details($keyPair);
$publicKey = $keyDetails['key'];

// Simpan kunci ke file
file_put_contents(__DIR__ . '/keys/private_key.pem', $privateKey);
file_put_contents(__DIR__ . '/keys/public_key.pem', $publicKey);

echo "Kunci RSA berhasil dibuat dan disimpan.";