const db = require("../config/db");
const bcrypt = require("bcryptjs");

class User {
  static async create(username, password) {
    const hashedPassword = await bcrypt.hash(password, 10);
    return db.execute("INSERT INTO users (username, password) VALUES (?, ?)", [
      username,
      hashedPassword,
    ]);
  }

  static async findByUsername(username) {
    const [rows] = await db.execute("SELECT * FROM users WHERE username = ?", [
      username,
    ]);
    return rows[0];
  }

  static async findById(id) {
    const [rows] = await db.execute("SELECT * FROM users WHERE id = ?", [id]);
    return rows[0];
  }
}

module.exports = User;
