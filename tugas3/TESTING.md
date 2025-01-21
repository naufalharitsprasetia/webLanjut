# Skenario Testing

## 1. Test Fitur Generate Key
1. Buka **localhost** melalui browser.
2. Arahkan ke direktori tempat file `generate.php` berada, misalnya:  
   `http://localhost/weblanjut/tugas3/generate.php`.
3. Pastikan halaman dapat diakses tanpa error dan kunci berhasil dihasilkan.

## 2. Test Login dengan Kredensial yang Benar
1. Buka **localhost** melalui browser.
2. Masukkan kredensial berikut pada halaman login:  
   - **Username:** `admin`  
   - **Password:** `12345`
3. Verifikasi hasil:
   - Jika login berhasil, program berjalan dengan lancar.
   - Jika login gagal, maka test ini **tidak lulus**.

## 3. Test Login dengan Kredensial yang Salah
1. Buka **localhost** melalui browser.
2. Coba login dengan kredensial **yang salah**, misalnya:
   - **Username:** selain `admin`  
   - **Password:** selain `12345`
3. Verifikasi hasil:
   - Jika login ditolak dengan pesan "Login Salah," berarti program berjalan dengan baik.
   - Jika login berhasil, berarti terdapat **bug** dalam program.
