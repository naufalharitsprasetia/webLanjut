/** @format */

// TASK 1

function cetakAngka() {
  for (let i = 1; i <= 5; i++) {
    //Mengganti var dengan Menggunakan let untuk block-scoping pada i
    setTimeout(function () {
      console.log(i); // Output 1 hingga 5 sesuai dengan waktu
    }, i * 1000);
  }
}

cetakAngka();

// TASK 2

// Membuat Promise untuk pengambilan data (fetchData)
let fetchedData = new Promise((resolve, reject) => {
  setTimeout(() => {
    console.log("Data fetched");
    resolve({ data: "Some data" }); // Mengembalikan data yang di-fetch sebagai hasil dari Promise
  }, 2000);
});

// Menggunakan then pada fetchedData untuk memproses data setelah data berhasil diambil
let processedData = fetchedData.then((data) => {
  // Membuat Promise baru untuk memproses data (processData)
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      console.log("Processing data:", data);
      resolve(`Processed: ${data.data}`); // Mengembalikan data yang sudah diproses
    }, 2000);
  });
});

// Menggunakan then pada processedData untuk menyimpan data setelah data berhasil diproses
let savedData = processedData.then((processed) => {
  // Membuat Promise baru untuk menyimpan data (saveData)
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      console.log("Data saved:", processed);
      reject("Success (sengaja dibuat pesan error/reject :v)"); // Mengembalikan error/reject untuk mencoba/ngetes apakah fungsi .catch nya berjalan dengan baik
    }, 2000);
  });
});

// Menggunakan then pada savedData untuk menampilkan hasil akhir dari semua operasi
savedData
  .then((result) => {
    console.log("All operations completed:", result); // Menampilkan pesan berhasil setelah semua proses selesai
  })
  .catch((error) => {
    console.error("Error during operations:", error); // Menangani error jika terjadi kesalahan dalam salah satu Promise
  });
