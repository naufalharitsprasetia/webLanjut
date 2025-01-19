# Keamanan Form Login dengan Enkripsi RSA dan PHP

Proyek ini bertujuan untuk membuat form login yang aman menggunakan metode enkripsi RSA. Data login akan dienkripsi menggunakan kunci publik dan didekripsi menggunakan kunci privat. Proyek ini juga dilengkapi dengan validasi input dan sanitasi untuk mencegah serangan seperti SQL Injection dan XSS.

## Fitur
- **Enkripsi RSA**: Data login dienkripsi menggunakan kunci publik dan didekripsi menggunakan kunci privat.
- **Validasi Input**: Memastikan bahwa data yang dimasukkan valid.
- **Sanitasi Input**: Melindungi aplikasi dari SQL Injection dan XSS.
- **Manajemen Kunci RSA**: Mengelola kunci publik dan privat secara aman.
- **Pengujian Fungsionalitas**: Uji coba login berhasil dan gagal.

## Teknologi yang Digunakan
- PHP
- OpenSSL
- Laragon (Local Server)

## Cara Instalasi
1. **Clone Repository**
   ```bash
   git clone https://github.com/username/repo-name.git
   ```
2. **Konfigurasi OpenSSL**
   Pastikan OpenSSL terpasang di sistem Anda dan file konfigurasi `openssl.cnf` berada pada lokasi yang benar. Perbarui konfigurasi di `php.ini`:
   ```ini
   [openssl]
   openssl.cnf = "C:/Program Files/Common Files/SSL/openssl.cnf"
   ```

3. **Import Database**
   - Import file `database.sql` yang disertakan dalam proyek ini ke MySQL.
   - Konfigurasi database di file `config.php`.

4. **Jalankan Proyek**
   - Gunakan Laragon untuk menjalankan proyek ini di `http://localhost`.

## Struktur Proyek
```plaintext
.
├── generate.php        # File untuk menghasilkan kunci RSA
├── index.php           # Form login
├── keys/               # Folder untuk file kunci RSA
├── login.php           # File untuk memproses login
├── README.md           # Dokumentasi proyek
```

## Cara Kerja
1. **Pembuatan Kunci RSA**
   - Jalankan `generate.php` untuk membuat pasangan kunci RSA.
   - Kunci publik dan privat akan disimpan di folder `keys/`.

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

## Dokumentasi
- Penjelasan lengkap tersedia di file `README.md` ini.
- Laporan tambahan dan skenario pengujian disertakan dalam folder `docs/` jika diperlukan.

## Kontribusi Tim
- **Backend Developer**: [Nama Anggota 1, Nama Anggota 2]
- **Dokumentasi**: [Nama Anggota 3]
- **Pengujian**: [Nama Anggota 4]

## Lisensi
Proyek ini dilisensikan di bawah [Lisensi MIT](LICENSE).

