# **Final Project - Implementasi OAuth2 dengan Popup Form menggunakan Node.js, RSA, dan MySQL**

Proyek ini bertujuan untuk mengimplementasikan sistem autentikasi **OAuth2** menggunakan **Node.js**, **MySQL**, dan **RSA**. Pengguna dapat login melalui **popup form**, di mana autentikasi dilakukan menggunakan **access token** dan **refresh token** untuk keamanan yang lebih baik.

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
- **Enkripsi**: RSA (jsonwebtoken & crypto)
- **Frontend**: HTML, CSS, JavaScript (AJAX untuk popup form)
- **Middleware**: Passport.js (OAuth2 Strategy)

## **📥 Cara Instalasi**
1. **Clone Repository**
   ```bash
   git clone https://github.com/username/oauth2-popup-form.git
   cd oauth2-popup-form
   ```

2. **Pasang Dependensi**
   ```bash
   npm install
   ```

3. **Konfigurasi Database**
   - Buat database MySQL dengan nama oauth2_db
   - Jalankan file database.sql untuk membuat tabel yang dibutuhkan
   
4. **Buat Kunci RSA**
    - Jalankan perintah berikut untuk membuat private key dan public key : 
   ```bash
   openssl genpkey -algorithm RSA -out private.key -pkeyopt rsa_keygen_bits:2048
   openssl rsa -in private.key -pubout -out public.key
   ```
   - Simpan file private.key dan public.key di folder keys/

5. **Buat File Konfigurasi .env Buat file .env di root proyek dan isi dengan:**
   ```env
   PORT=3000
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=yourpassword
   DB_NAME=oauth2_db
   JWT_ACCESS_EXPIRY=15m
   JWT_REFRESH_EXPIRY=7d
   ```

6. **Jalankan Server**
   ```bash
   npm start
   ```
   Aplikasi akan berjalan di http://localhost:3000

## Struktur Proyek
```plaintext
.
├── config/
│   ├── auth.js          # Konfigurasi OAuth2 dan JWT
│   ├── db.js            # Koneksi ke database MySQL
│   ├── private.key      # Kunci privat RSA (Jangan dibagikan!)
│   ├── public.key       # Kunci publik RSA
├── models/
│   ├── user.js          # Model pengguna
│   ├── token.js         # Model token OAuth2
├── routes/
│   ├── authRoutes.js    # Endpoint autentikasi (login, refresh, logout)
├── public/
│   ├── index.html       # Halaman login dengan popup form
├── server.js            # File utama untuk menjalankan server
├── .env                 # File konfigurasi lingkungan
├── package.json         # Dependensi proyek
├── package-lock.json    # Dependensi proyek
└── README.md            # Dokumentasi proyek
```

## Skema Database 
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    refresh_token TEXT NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 🔄 Alur Kerja OAuth2
- Pengguna mengisi form login di popup modal
- Data dikirim ke server, dienkripsi dengan RSA
- Server memverifikasi kredensial pengguna
- Jika valid, server mengembalikan access token (15 menit) dan refresh token (7 hari)
- Access token digunakan untuk mengakses endpoint yang membutuhkan autentikasi
- Jika access token expired, client menggunakan refresh token untuk mendapatkan access token baru tanpa login ulang

## 📜 API Endpoint
| Method |	Endpoint	    | Deskripsi                                          |
| POST   |	/api/login	    | Login & dapatkan access token + refresh token      |
| POST   |	/api/refresh    | Dapatkan access token baru dengan refresh token    |
| POST   |	/api/logout	    | Logout dan hapus refresh token                     |    
| GET    |	/api/user	    | Ambil data pengguna (dengan access token)          |

## ⚠️ Keamanan yang Diterapkan
- 🔒 RSA-2048: Semua token ditandatangani menggunakan RSA private key
- 🔒 Hashing Password: Password disimpan menggunakan bcrypt
- 🔒 HTTPS (Opsional): Dianjurkan untuk menggunakan HTTPS saat deploy
- 🔒 Sanitasi Input: Semua input diperiksa untuk mencegah SQL Injection & XSS

## Pengujian
- _Login Berhasil_: Gunakan kredensial valid → Access token & refresh token dikembalikan
- _Login Gagal_: Gunakan kredensial salah → Respon error 401 Unauthorized
- _Access Token Expired_: Coba akses endpoint dengan access token yang sudah kadaluarsa
- _Refresh Token Expired_: Gunakan refresh token setelah lebih dari 7 hari → Harus login ulang
- _Keamanan Input_: Uji input dengan karakter berbahaya untuk melihat apakah sistem aman dari serangan injeksi

## Kontribusi Tim
- **Backend Developer**: NAUFAL HARITS PRASETIA
- **Dokumentasi**: NAUFAL HARITS PRASETIA
- **Pengujian**: NAUFAL HARITS PRASETIA

## Lisensi
Proyek ini dilisensikan di bawah [Lisensi MIT](../LICENSE).

