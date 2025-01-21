# Skenario Testing

## 1. Test Fitur Generate Key
1. Buka **localhost** melalui browser.
2. Arahkan ke direktori tempat file `generate.php` berada, misalnya:  
   `http://localhost/weblanjut/tugas3/generate.php`.
3. Pastikan halaman dapat diakses tanpa error dan kunci berhasil dihasilkan.

### Hasil Pengujian:
- Halaman dapat diakses tanpa error.
- Kunci RSA berhasil dihasilkan dan disimpan di folder keys/.
**Status: Sesuai Ekspektasi / Testing Successful**


## 2. Test Login dengan Kredensial yang Benar
1. Buka **localhost** melalui browser.
2. Masukkan kredensial berikut pada halaman login:  
   - **Username:** `admin`  
   - **Password:** `12345`
3. Verifikasi hasil:
   - Jika login berhasil, program berjalan dengan lancar.
   - Jika login gagal, maka test ini **tidak lulus**.

### Hasil Pengujian:
- Login berhasil dilakukan dengan kredensial yang benar.
- Sistem mengarahkan pengguna ke halaman utama tanpa error.
**Status: Sesuai Ekspektasi / Testing Successful**

## 3. Test Login dengan Kredensial yang Salah
1. Buka **localhost** melalui browser.
2. Coba login dengan kredensial **yang salah**, misalnya:
   - **Username:** selain `admin`  
   - **Password:** selain `12345`
3. Verifikasi hasil:
   - Jika login ditolak dengan pesan "Login Salah," berarti program berjalan dengan baik.
   - Jika login berhasil, berarti terdapat **bug** dalam program.

### Hasil Pengujian:
- Sistem menolak login dan menampilkan pesan "Login Salah" sesuai skenario.
- Sistem tetap aman dari akses dengan kredensial yang tidak valid
**Status: Sesuai Ekspektasi / Testing Successful**