const express = require("express");
const jwt = require("jsonwebtoken");
const bcrypt = require("bcryptjs");
const db = require("../config/db");
const router = express.Router();
const NodeRSA = require("node-rsa");
const fs = require("fs");
const path = require("path");
require("dotenv").config();

// Generate atau load kunci RSA
const privateKeyPath = path.join(__dirname, "../keys/private.pem");
const publicKeyPath = path.join(__dirname, "../keys/public.pem");

let privateKey, publicKey;

if (!fs.existsSync(privateKeyPath) || !fs.existsSync(publicKeyPath)) {
  const key = new NodeRSA({ b: 2048 });
  privateKey = key.exportKey("private");
  publicKey = key.exportKey("public");

  // Simpan ke file
  fs.writeFileSync(privateKeyPath, privateKey);
  fs.writeFileSync(publicKeyPath, publicKey);
} else {
  privateKey = fs.readFileSync(privateKeyPath, "utf8");
  publicKey = fs.readFileSync(publicKeyPath, "utf8");
}

// **Route untuk mengirim public key ke frontend**
router.get("/publicKey", (req, res) => {
  res.send(publicKey);
});

// **Registrasi User**
router.post("/register", async (req, res) => {
  const { username, password } = req.body;

  const hashedPassword = await bcrypt.hash(password, 10);

  db.query(
    "INSERT INTO users (username, password) VALUES (?, ?)",
    [username, hashedPassword],
    (err, result) => {
      if (err)
        return res.status(500).json({ message: "Username sudah digunakan" });

      res.json({ message: "Registrasi berhasil, silakan login" });
    }
  );
});

// **Login User dengan Dekripsi RSA**
router.post("/login", (req, res) => {
  const { username, password } = req.body;

  try {
    const key = new NodeRSA(privateKey, "pkcs1-private", {
      encryptionScheme: "pkcs1",
    });
    const decryptedPassword = key.decrypt(password, "utf8");

    db.query(
      "SELECT * FROM users WHERE username = ?",
      [username],
      async (err, result) => {
        if (err) return res.status(500).json({ message: "Server error" });

        if (result.length === 0)
          return res.status(401).json({ message: "User tidak ditemukan" });

        const user = result[0];
        const isMatch = await bcrypt.compare(decryptedPassword, user.password);

        if (!isMatch)
          return res.status(401).json({ message: "Password salah" });

        const token = jwt.sign(
          { username: user.username },
          process.env.JWT_SECRET,
          { expiresIn: "1h" }
        );

        res
          .cookie("token", token, { httpOnly: true, secure: true })
          .json({ message: "Login berhasil", token });
      }
    );
  } catch (error) {
    res.status(400).json({ message: "Gagal mendekripsi password" + error });
  }
});

// **Cek Session**
router.get("/session", (req, res) => {
  const token = req.cookies.token;

  if (!token) return res.status(401).json({ message: "Unauthorized" });

  jwt.verify(token, process.env.JWT_SECRET, (err, decoded) => {
    if (err) return res.status(401).json({ message: "Token invalid" });

    res.json({ user: decoded });
  });
});

// **Logout User**
router.post("/logout", (req, res) => {
  res.clearCookie("token").json({ message: "Logout berhasil" });
});

module.exports = router;
