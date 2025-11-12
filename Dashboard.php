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

        /* Tabel faktur */
        .content {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        table {
            border-collapse: collapse;
            width: 65%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
            margin-bottom: 40px;
        }
        th, td {
            border-right: 3px solid #4682B4;
        }
        th:last-child, td:last-child {
            border-right: none;
        }
        th {
            background: linear-gradient(135deg, #87CEEB, #4682B4);
            color: white;
            padding: 12px;
            text-align: center;
            font-size: 18px;
        }
        td {
            padding: 12px 15px;
            border-bottom: 3px solid #4682B4;
            color: #032B44;
            font-size: 16px;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #F0F8FF;
        }
        tr:nth-child(odd) {
            background-color: #E6F3FF;
        }
        .separator {
            width: 65%;
            height: 4px;
            background: linear-gradient(135deg, #87CEEB, #4682B4);
            border-radius: 2px;
            margin: 0 0 40px 0;
        }
        .thankyou-text {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 18px;
            color: #2e59d9;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            transition: color 0.3s ease;
        }
        .thankyou-text:hover {
            color: #4682B4;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo-section">
        <div class="logo">PM</div>
        <div class="logo-text">
            <h2>---POLGAN MART---</h2>
            <p>Sistem Penjualan Sederhana</p>
        </div>
    </div>
    <div class="user-info">
        <h3>Selamat datang, <?php echo $_SESSION['username']; ?>!</h3>
        <p>Role: <?php echo $_SESSION['role']; ?></p>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</div>

<div class="content">
    <?php
    $barang = array(
        array("KA001", "Jilbab", 50000),
        array("KA002", "Gamis", 250000),
        array("KA003", "Jeket", 100000),
        array("KA004", "Rok", 75000),
        array("KA005", "Sepatu", 150000)
    );

    // Tambahan array dan logika acak
    $beli       = array();
    $jumlah     = array();
    $total      = array();
    $grandtotal = 0;

    // Pilih 5 barang acak
    for ($i = 0; $i < 5; $i++) {
        $acak = rand(0, count($barang) - 1);
        $beli[$i]   = $barang[$acak];
        $jumlah[$i] = rand(1, 5);
        $total[$i]  = $beli[$i][2] * $jumlah[$i];
        $grandtotal += $total[$i];
    }

    // DISKON sesuai ketentuan
    $diskon_percent = 0;
    if ($grandtotal < 50000) {
        $diskon_percent = 5;
    } elseif ($grandtotal <= 100000) {
        $diskon_percent = 10;
    } else {
        $diskon_percent = 15;
    }
    $diskon_amount = ($diskon_percent / 100) * $grandtotal;
    $total_bayar = $grandtotal - $diskon_amount;

    // Tabel faktur / struk
    echo "<div style='width:65%; background:white; border:3px solid #4682B4; border-radius:10px; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.1); margin-bottom:40px;'>";
    echo "<table style='width:100%; border-collapse: collapse; margin-top:20px;'>";
    echo "<tr style='background:#87CEEB; color:white;'>
            <th style='text-align:center; padding:8px;'>No</th>
            <th style='text-align:center; padding:8px;'>Kode Barang</th>
            <th style='text-align:center; padding:8px;'>Nama Barang</th>
            <th style='text-align:center; padding:8px;'>Jumlah</th>
            <th style='text-align:center; padding:8px;'>Subtotal</th>
          </tr>";

    foreach ($beli as $index => $item) {
        $no = $index + 1;
        echo "<tr>
                <td style='padding:8px; text-align:center;'>".$no."</td>
                <td style='padding:8px; text-align:center;'>{$item[0]}</td>
                <td style='padding:8px; text-align:center;'>". strtoupper($item[1]) ."</td>
                <td style='padding:8px; text-align:center;'>{$jumlah[$index]} pcs</td>
                <td style='padding:8px; text-align:center;'>Rp ". number_format($total[$index],0,',','.') ."</td>
              </tr>";
    }

    echo "<tr style='background:#C6EFFE; font-weight:bold;'>
            <td colspan='4' style='padding:8px; text-align:right;'>Total Belanja:</td>
            <td style='padding:8px; text-align:center;'>Rp ". number_format($grandtotal,0,',','.') ."</td>
          </tr>";
    echo "<tr style='background:#C6EFFE; font-weight:bold;'>
            <td colspan='4' style='padding:8px; text-align:right;'>DISKON (".$diskon_percent."%):</td>
            <td style='padding:8px; text-align:center;'>Rp ". number_format($diskon_amount,0,',','.') ."</td>
          </tr>";
    echo "<tr style='background:#87CEEB; color:white; font-weight:bold;'>
            <td colspan='4' style='padding:8px; text-align:right;'>TOTAL BAYAR:</td>
            <td style='padding:8px; text-align:center;'>Rp ". number_format($total_bayar,0,',','.') ."</td>
          </tr>";
    echo "</table>";
    echo "<p class='thankyou-text' style='text-align:center; margin-top:20px;'>Terima Kasih telah berbelanja di POLGAN MART!</p>";
    echo "</div>";
    ?>
</div>

</body>
</html>
