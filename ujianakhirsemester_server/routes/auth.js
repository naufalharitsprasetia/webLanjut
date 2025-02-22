const express = require("express");
const jwt = require("jsonwebtoken");
const bcrypt = require("bcryptjs");
const db = require("../config/db");
const router = express.Router();
require("dotenv").config();

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

// **Login User**
router.post("/login", (req, res) => {
  const { username, password } = req.body;

  db.query(
    "SELECT * FROM users WHERE username = ?",
    [username],
    async (err, result) => {
      if (err) return res.status(500).json({ message: "Server error" });

      if (result.length === 0)
        return res.status(401).json({ message: "User tidak ditemukan" });

      const user = result[0];
      const isMatch = await bcrypt.compare(password, user.password);

      if (!isMatch) return res.status(401).json({ message: "Password salah" });

      // Buat token
      const secretKey = "secret123";
      const token = jwt.sign({ username: user.username }, secretKey, {
        expiresIn: "1h",
      });
      res
        .cookie("token", token, { httpOnly: true })
        .json({ message: "Login berhasil", token });
    }
  );
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
