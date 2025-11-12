<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f6f7fb;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f8f9fc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 10px 30px;
        }
        .logo-section {
            display: flex;
            align-items: center;
        }
        .logo {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 16px;
        }
        .logo-text h2 {
            margin: 0;
            color: #2e59d9;
            font-size: 18px;
        }
        .logo-text p {
            margin: 0;
            font-size: 12px;
            color: #858796;
        }
        .user-info {
            text-align: right;
        }
        .user-info h3 {
            margin: 0;
            font-size: 16px;
            color: #2e2e2e;
        }
        .user-info p {
            margin: 2px 0;
            font-size: 13px;
            color: #858796;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 5px;
            background-color: #4e73df;
            color: white;
            padding: 6px 14px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 13px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #2e59d9;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo-section">
        <div class="logo">PM</div>
        <div class="logo-text">
            <h2>--POLGAN MART--</h2>
            <p>Sistem Penjualan Sederhana</p>
        </div>
    </div>
    <div class="user-info">
        <h3>Selamat datang, <?php echo $_SESSION['username']; ?>!</h3>
        <p>Role: <?php echo $_SESSION['role']; ?></p>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
