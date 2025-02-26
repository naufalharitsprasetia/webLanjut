# **Final Project - Implementasi OAuth2 dengan Popup Form menggunakan Node.js, RSA, dan MySQL**

Proyek ini bertujuan untuk mengimplementasikan sistem autentikasi **OAuth2** menggunakan **Node.js**, **MySQL**, dan **RSA**. Pengguna dapat login melalui **popup form**, di mana autentikasi dilakukan menggunakan **access token** dan **refresh token** untuk keamanan yang lebih baik.

- Download ZIP file :  [FINAL PROJECT](https://github.com).

## **🛠️ Fitur**
✅ **OAuth2 Authentication** → Login menggunakan OAuth2 dengan **access token & refresh token**  
✅ **RSA Encryption** → Token ditandatangani dengan **RSA 2048-bit** untuk keamanan lebih tinggi  
✅ **Popup Form Login** → UI login responsif dalam bentuk popup modal  
✅ **Refresh Token Mechanism** → Pengguna bisa mendapatkan access token baru tanpa perlu login ulang  
✅ **MySQL Database** → Menyimpan data pengguna dan token secara aman  
✅ **Input Validation & Sanitization** → Melindungi dari serangan **SQL Injection & XSS**  

## **📌 Teknologi yang Digunakan**
- **Backend**: Node.js (Express.js)
- **Database**: MySQL
- **Enkripsi**: RSA
- **Frontend**: HTML, CSS, JavaScript (AJAX untuk popup form)

## **📥 Cara Instalasi**
1. **Clone Repository**
   ```bash
   git clone https://github.com/naufalharitsprasetia/webLanjut.git
   cd webLanjut
   cd ujianakhirsemester_server
   ```

2. **Pasang Dependensi**
   ```bash
   npm install
   ```

3. **Konfigurasi Database**
   - Buat database MySQL di phpmyadmin dengan nama **'uasweblanjut'**
   - import database **'uasweblanjut.sql'** yang berada di folder config 
   
4. **Buat File Konfigurasi .env Buat file .env di root proyek dan isi dengan:**
   (jika belum ada) , (sesuaikan dengan konfigutasi komputer masing2)
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=uasweblanjut
   JWT_SECRET=your_jwt_secret
   PORT=5000
   ```

5. **Jalankan Server**
   jalankan perintah berikut di terminal :
   ```bash
   node server.js
   ```
   Aplikasi akan berjalan di http://localhost:5000

6. **Jalankan index.html**
   - buka file index.html di folder /public/ , kemudian :
   - klik kanan, open file with live server.

## Struktur Proyek
```plaintext
.
├── config/
│   ├── db.js            # Koneksi ke database MySQL
│   ├── uasweblanjut.sql # database
├── keys/
│   ├── private.pem      # Kunci privat RSA (Jangan dibagikan!)
│   ├── public.pem       # Kunci publik RSA
├── routes/
│   ├── auth.js          # Endpoint autentikasi (login, register, logout)
├── public/
│   ├── index.html       # Halaman login & register dengan popup form
│   ├── dashboard.html   # Halaman dashboard ketika berhasil login
├── server.js            # File utama untuk menjalankan server
├── .env                 # File konfigurasi lingkungan
├── package.json         # Dependensi proyek
├── package-lock.json    # Dependensi proyek
└── README.md            # Dokumentasi proyek
```

## 🔄 Alur Kerja OAuth2
- Pengguna mengisi form login di popup modal
- Data dikirim ke server, dienkripsi dengan RSA
- Server memverifikasi kredensial pengguna
- Jika valid, server mengembalikan access token (15 menit) dan refresh token (7 hari)
- Access token digunakan untuk mengakses endpoint yang membutuhkan autentikasi
- Jika access token expired, client menggunakan refresh token untuk mendapatkan access token baru tanpa login ulang

## 📜 API Endpoint
| Method |	Endpoint	       | Deskripsi                                          |

| POST   |	/auth/login	    | Login & dapatkan access token + refresh token      |

| POST   |	/auth/register  | Daftar user baru                                   |

| POST   |	/auth/logout	 | Logout dan hapus refreshtoken                      |   

| GET    |	/auth/publicKey | mengirim public key ke frontend                    |

| GET    |	/auth/session   | cek session                                        |

## ⚠️ Keamanan yang Diterapkan
- 🔒 RSA-2048: Semua token ditandatangani menggunakan RSA private key
- 🔒 Hashing Password: Password disimpan menggunakan bcrypt
- 🔒 HTTPS (Opsional): Dianjurkan untuk menggunakan HTTPS saat deploy
- 🔒 Sanitasi Input: Semua input diperiksa untuk mencegah SQL Injection & XSS

## Pengujian
- _Login Berhasil_: Gunakan kredensial valid → Access token & refresh token dikembalikan
- _Login Gagal_: Gunakan kredensial salah → Respon error 401 Unauthorized
- _Keamanan Input_: Uji input dengan karakter berbahaya untuk melihat apakah sistem aman dari serangan injeksi

## Kontribusi Tim
- **Backend Developer**: NAUFAL HARITS PRASETIA
- **Dokumentasi**: ALVIN ARYA PANGESTU
- **Pengujian**: Alvin & Naufal

## Lisensi
Proyek ini dilisensikan di bawah [Lisensi MIT](../LICENSE).

## NB : Jika Ada Error ketika aplikasi di jalankan
- Pastikan Server (Node.js) nya sudah menyala dan berjalan ketika membuka aplikasi (index.html).
- Pastikan Mysql nya juga sudah menyala ketika aplikasi berjalan.
- pastikan file index.html berjalan diatas web server (live server) / localhost, bukan open with browser biasa.
1. jika ada pesan error, pahamsi pesan tersebut terlebih dahulu, kemudian cari solusi nya
2. buka console , (inspect elemen, tab > console), perhatikan ada error atau tidak
3. hubungi kami : 081220594202