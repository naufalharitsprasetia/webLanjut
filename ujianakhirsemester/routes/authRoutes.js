const express = require("express");
const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");
const { generateToken, verifyToken } = require("../config/auth");
const User = require("../models/user");
const Token = require("../models/token");

const router = express.Router();

// Register User
router.post("/register", async (req, res) => {
  const { username, password } = req.body;
  try {
    await User.create(username, password);
    res.status(201).json({ message: "User registered" });
  } catch (error) {
    res.status(400).json({ error: "User already exists" });
  }
});

// Login User
router.post("/login", async (req, res) => {
  const { username, password } = req.body;
  const user = await User.findByUsername(username);

  if (!user || !(await bcrypt.compare(password, user.password))) {
    return res.status(401).json({ error: "Invalid credentials" });
  }

  const accessToken = generateToken(user);
  const refreshToken = jwt.sign({ id: user.id }, process.env.JWT_SECRET, {
    expiresIn: "7d",
  });

  await Token.create(
    user.id,
    accessToken,
    refreshToken,
    new Date(Date.now() + 15 * 60 * 1000)
  );
  res.json({ accessToken, refreshToken });
});

// Refresh Token
router.post("/refresh", async (req, res) => {
  const { refreshToken } = req.body;
  const storedToken = await Token.findByRefreshToken(refreshToken);

  if (!storedToken) {
    return res.status(403).json({ error: "Invalid refresh token" });
  }

  const accessToken = generateToken({ id: storedToken.user_id });
  res.json({ accessToken });
});

module.exports = router;
