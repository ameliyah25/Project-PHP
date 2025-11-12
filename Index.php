<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 40px 35px;
        width: 320px;
        text-align: center;
    }
    .login-container h2 {
        color: #2c6bed;
        margin-bottom: 25px;
        font-size: 22px;
        letter-spacing: 1px;
    }
    .form-group {
        text-align: left;
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: #2f4f4f;
        letter-spacing: 0.02em;
        line-height: 1.3;
        text-transform: capitalize;
    }
    .form-group input {
        width: 100%;
        margin: 5px auto;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }
    .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-login {
        background: #2c6bed;
        color: white;
        margin-top: 10px;
    }
    .btn-login:hover {
        background: #1d54c4;
    }
    .btn-batal {
        background: #f2f2f2;
        color: #333;
        margin-top: 8px;
    }
    .btn-batal:hover {
        background: #e0e0e0;
    }
    .footer {
        margin-top: 25px;
        font-size: 12px;
        color: #888;
    }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>POLGAN MART</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" placeholder="" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="" required>
            </div>
            <button type="submit" class="btn btn-login">Login</button>
            <button type="reset" class="btn btn-batal">Batal</button>
        </form>
        <div class="footer">© 2025 POLGAN MART</div>
    </div>
</body>
</html>
