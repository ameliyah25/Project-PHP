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

        /* Tabel penjualan */
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

        /* Garis pemisah antara tabel 1 dan tabel 2 */
        .separator {
            width: 65%;
            height: 4px;
            background: linear-gradient(135deg, #87CEEB, #4682B4);
            border-radius: 2px;
            margin: 0 0 40px 0;
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

<div class="content">
    <?php
    $barang = array(
        array("KA001", "Jilbab", 50000),
        array("KA002", "Gamis", 250000),
        array("KA003", "Jeket", 100000),
        array("KA004", "Rok", 75000),
        array("KA005", "Sepatu", 150000)
    );

    // Tabel daftar barang
    echo "<table>";
    echo "<tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
          </tr>";
    foreach ($barang as $item) {
        echo "<tr>
                <td>{$item[0]}</td>
                <td>" . strtoupper($item[1]) . "</td>
                <td>Rp " . number_format($item[2], 0, ',', '.') . "</td>
              </tr>";
    }
    echo "</table>";

    // Garis pemisah antara tabel
    echo "<div class='separator'></div>";

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
        // hitung total harga per item
        $total[$i]  = $beli[$i][2] * $jumlah[$i];
        // akumulasikan ke grandtotal
        $grandtotal += $total[$i];
    }

    // Tabel pembelian acak
    echo "<table>";
    echo "<tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
          </tr>";
    foreach ($beli as $index => $item) {
        echo "<tr>
                <td>{$item[0]}</td>
                <td>" . strtoupper($item[1]) . "</td>
                <td>Rp " . number_format($item[2], 0, ',', '.') . "</td>
                <td>{$jumlah[$index]}</td>
                <td>Rp " . number_format($total[$index], 0, ',', '.') . "</td>
              </tr>";
    }
    echo "<tr style='background:#d0e7ff; font-weight:bold;'>
            <td colspan='4' style='text-align:right;'>GRAND TOTAL</td>
            <td>Rp " . number_format($grandtotal, 0, ',', '.') . "</td>
          </tr>";
    echo "</table>";

     // Garis pemisah antara tabel
    echo "<div class='separator'></div>";

    // Fakur / Struk Total Belanja
    echo "<div style='width:65%; background:white; border:3px solid #4682B4; border-radius:10px; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.1); margin-bottom:40px;'>";
    echo "<h3 style='text-align:center; color:#4682B4;'>FAKTUR BELANJA</h3>";
    echo "<p style='text-align:center;'>No. Faktur: PM" . date('YmdHis') . "<br>";
    echo "Tanggal: ". date('d/m/Y') ." | Waktu: ". date('H:i:s') ."</p>";
    echo "<table style='width:100%; border-collapse: collapse; margin-top:20px;'>";
    echo "<tr style='background:#87CEEB; color:white;'>
            <th style='text-align:left; padding:8px;'>No</th>
            <th style='text-align:left; padding:8px;'>Kode Barang</th>
            <th style='text-align:left; padding:8px;'>Nama Barang</th>
            <th style='text-align:right; padding:8px;'>Jumlah</th>
            <th style='text-align:right; padding:8px;'>Subtotal</th>
          </tr>";

   foreach ($beli as $index => $item) {
    $no = $index + 1;
    echo "<tr>
            <td style='padding:8px;'>".$no."</td>
            <td style='padding:8px;'>{$item[0]}</td>
            <td style='padding:8px;'>". strtoupper($item[1]) ."</td>
            <td style='padding:8px; text-align:right;'>{$jumlah[$index]} pcs</td>
            <td style='padding:8px; text-align:right;'>Rp ". number_format($total[$index],0,',','.') ."</td>
          </tr>";
}

    echo "<tr style='background:#C6EFFE; font-weight:bold;'>
            <td colspan='4' style='padding:8px; text-align:right;'>TOTAL BAYAR:</td>
            <td style='padding:8px; text-align:right;'>Rp " . number_format($grandtotal,0,',','.') . "</td>
          </tr>";
    echo "</table>";
    echo "<p style='text-align:center; margin-top:20px;'>Terima Kasih telah berbelanja di POLGAN MART!</p>";
    echo "</div>";
    ?>
</div>

</body>
</html>
