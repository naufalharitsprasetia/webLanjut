<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/node-forge@1.3.1/dist/forge.min.js"></script>
    <script>
    async function encryptPassword(event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        const publicKeyPEM = await fetch('./keys/public_key.pem').then(res => res.text());
        const publicKey = forge.pki.publicKeyFromPem(publicKeyPEM);

        const encryptedPassword = forge.util.encode64(publicKey.encrypt(password));


        // Submit encrypted password
        const form = event.target;
        const encryptedField = document.createElement('input');
        encryptedField.type = 'hidden';
        encryptedField.name = 'encryptedPassword';
        encryptedField.value = encryptedPassword;

        form.appendChild(encryptedField);
        form.submit();
    }
    </script>
</head>

<body>
    <form onsubmit="encryptPassword(event)" method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>