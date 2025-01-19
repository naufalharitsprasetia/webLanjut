<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Secure Login</title>
    <script src="https://cdn.rawgit.com/travist/jsencrypt/master/bin/jsencrypt.min.js"></script>
    <script>
    async function encryptPassword(event) {
        event.preventDefault();
        const password = document.getElementById('password').value;

        // Ambil public key
        const publicKey = await fetch('./keys/public_key.pem').then(res => res.text());

        // Enkripsi password
        const encrypt = new JSEncrypt();
        encrypt.setPublicKey(publicKey);
        const encryptedPassword = encrypt.encrypt(password);

        // Kirim data terenkripsi
        document.getElementById('encryptedPassword').value = encryptedPassword;
        document.getElementById('loginForm').submit();
    }
    </script>
</head>

<body>
    <form id="loginForm" action="login.php" method="POST" onsubmit="encryptPassword(event)">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" required><br><br>

        <input type="hidden" id="encryptedPassword" name="encryptedPassword">
        <button type="submit">Login</button>
    </form>
</body>

</html>