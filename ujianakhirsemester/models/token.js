const db = require("../config/db");

class Token {
  static async create(user_id, access_token, refresh_token, expires_at) {
    return db.execute(
      "INSERT INTO tokens (user_id, access_token, refresh_token, expires_at) VALUES (?, ?, ?, ?)",
      [user_id, access_token, refresh_token, expires_at]
    );
  }

  static async findByRefreshToken(refresh_token) {
    const [rows] = await db.execute(
      "SELECT * FROM tokens WHERE refresh_token = ?",
      [refresh_token]
    );
    return rows[0];
  }
}

module.exports = Token;
