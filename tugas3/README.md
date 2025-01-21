# Keamanan Form Login dengan Enkripsi RSA dan PHP

Proyek ini bertujuan untuk membuat form login yang aman menggunakan metode enkripsi RSA dengan bahasa PHP. Data login akan dienkripsi menggunakan kunci publik dan didekripsi menggunakan kunci privat. Proyek ini juga dilengkapi dengan validasi input dan sanitasi untuk mencegah serangan seperti SQL Injection dan XSS.

## Fitur
- **Enkripsi RSA**: Data login dienkripsi menggunakan kunci publik dan didekripsi menggunakan kunci privat.
- **Validasi Input**: Memastikan bahwa data yang dimasukkan valid.
- **Sanitasi Input**: Melindungi aplikasi dari SQL Injection dan XSS.
- **Manajemen Kunci RSA**: Mengelola kunci publik dan privat secara aman.
- **Pengujian Fungsionalitas**: Uji coba login berhasil dan gagal.

## Teknologi yang Digunakan
- **Bahasa Pemrograman**: PHP
- **Library**: [phpseclib3](https://github.com/phpseclib/phpseclib) 
- **Library**: Node-forge (v1.3.1): Library JavaScript untuk enkripsi RSA di sisi klien. [cdn](https://cdn.jsdelivr.net/npm/node-forge@1.3.1/dist/forge.min.js) 
- **Server Lokal**: Laragon

## Cara Instalasi
1. **Clone Repository**
   ```bash
   git clone https://github.com/naufalharitsprasetia/webLanjut.git
   ```

2. **Pasang Dependensi (phpseclib)**
   - Install Composer jika belum terpasang di sistem Anda.
   - Jalankan perintah berikut untuk memasang library yang diperlukan:

   ```bash
   composer require phpseclib/phpseclib
   ```
   - Jika Anda tidak menggunakan Composer, unduh pustaka dari phpseclib dan sertakan file autoload di proyek Anda.

3. **Jalankan Proyek**
   - Gunakan Laragon untuk menjalankan proyek ini di `http://localhost/{nama-direktori}`.

## Struktur Proyek
```plaintext
.
├── generate.php        # Script untuk menghasilkan kunci RSA (public & private key)
├── index.php           # Halaman utama untuk form login
├── keys/               # Folder untuk menyimpan file kunci RSA
│   ├── private.key     # Kunci privat RSA
│   └── public.key      # Kunci publik RSA
├── vendor/             # Folder untuk dependensi Composer (otomatis dibuat oleh Composer)
├── composer.json       # File konfigurasi Composer untuk dependensi PHP
├── composer.lock       # File lock Composer untuk versi dependensi
├── login.php           # Script untuk memproses login
├── LICENSE             # File lisensi proyek (MIT License)
├── TESTING.md          # Dokumentasi skenario dan langkah-langkah pengujian
├── README.md           # Dokumentasi proyek utama, termasuk cara instalasi dan penggunaan
```

## Cara Kerja
1. **Pembuatan Kunci RSA**
   - Jalankan `generate.php` untuk membuat pasangan kunci RSA.
   - Kunci publik dan privat akan disimpan di folder `keys/` menggunakan library `phpseclib3`.

2. **Proses Login**
   - Pengguna memasukkan data login di `index.php`.
   - Data dienkripsi menggunakan kunci publik dan dikirim ke server.
   - Server mendekripsi data menggunakan kunci privat dan memverifikasi kredensial.

3. **Validasi dan Sanitasi**
   - Data input divalidasi untuk memastikan format yang benar.
   - Input disanitasi untuk mencegah SQL Injection dan XSS.

## Pengujian
- **Login Berhasil**: Pastikan pengguna dapat login dengan kredensial yang benar.
- **Login Gagal**: Tampilkan pesan kesalahan untuk kredensial yang salah.
- **Keamanan Input**: Uji dengan input berbahaya untuk memastikan sanitasi bekerja.

## Kredensial untuk Login 
- username : admin 
- password : 12345

## Dokumentasi
- Penjelasan lengkap tersedia di file `README.md` ini.
- Skenario Testing ada di [TESTING.md](testing.md) ini.
- Laporan tambahan dan skenario pengujian disertakan dalam folder `docs/` jika diperlukan.

## Kontribusi Tim
- **Backend Developer**: NAUFAL HARITS PRASETIA
- **Dokumentasi**: NAUFAL HARITS PRASETIA
- **Pengujian**: NAUFAL HARITS PRASETIA

## Lisensi
Proyek ini dilisensikan di bawah [Lisensi MIT](../LICENSE).

