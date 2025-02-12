const fs = require("fs");
const jwt = require("jsonwebtoken");

// Baca Private dan Public Key
const privateKey = fs.readFileSync("config/private.pem", "utf8");
const publicKey = fs.readFileSync("config/public.pem", "utf8");

// Fungsi untuk generate token dengan RSA
const generateToken = (user) => {
  return jwt.sign({ id: user.id, username: user.username }, privateKey, {
    algorithm: "RS256",
    expiresIn: "1h",
  });
};

// Fungsi untuk verifikasi token
const verifyToken = (token) => {
  return jwt.verify(token, publicKey, { algorithms: ["RS256"] });
};

module.exports = { generateToken, verifyToken };
