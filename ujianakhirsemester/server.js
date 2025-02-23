const express = require("express");
const cors = require("cors");
const cookieParser = require("cookie-parser");
const authRoutes = require("./routes/auth");
require("dotenv").config();

const app = express();
const PORT = process.env.PORT || 5000;

app.use(
  cors({
    origin: ["http://localhost:5500", "http://127.0.0.1:5500"], // Izinkan kedua origin
    credentials: true, // Izinkan cookies
    methods: ["GET", "POST"], // Batasi ke metode yang dibutuhkan
  })
);

app.use(express.json());
app.use(cookieParser());

// Routes
app.use("/auth", authRoutes);

app.listen(PORT, () =>
  console.log(`Server berjalan di http://localhost:${PORT}`)
);
