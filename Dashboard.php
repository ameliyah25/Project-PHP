<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>POLGAN MART — Sistem Penjualan Sederhana</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f3f5fa;
        }
        .card-custom {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 10px blue;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 22px;
            color: blue;
        }
        .brand-sub {
            font-size: 13px;
            color: black;
        }
        th, td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<!-- HEADER (navbar diperbaiki) -->
<nav class="navbar bg-white px-4 shadow-sm d-flex align-items-center">
    <div class="d-flex align-items-center">
        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
             style="width:45px; height:45px; font-weight:bold;">
            PM
        </div>

        <div class="ms-3">
            <div class="navbar-brand">--POLGAN MART--</div>
            <div class="brand-sub">Sistem Penjualan Sederhana</div>
        </div>
    </div>

    <div class="ms-auto text-end">
        <div class="fw-bold">Selamat datang, admin!</div>
        <div style="font-size: 13px; color: gray;">Role: Mahasiswa</div>
      <a href="logout.php" class="btn btn-primary btn-sm mt-1">Logout</a>
    </div>
</nav>

<div class="container py-5">
    <div class="card-custom">
        <!-- FORM INPUT -->
        <div class="row mb-4">

            <!-- KODE BARANG (SELECT OTOMATIS) -->
            <div class="col-md-12">
                <label class="fw-bold">Kode Barang</label>
                <select id="kode" class="form-control">
                    <option value="">Pilih Kode Barang</option>
                    <option value="KA001" data-nama="Kemeja" data-harga="50000">KA001 - Kemeja</option>
                    <option value="KA002" data-nama="Rok" data-harga="80000">KA002 - Rok</option>
                    <option value="KA003" data-nama="Jilbab" data-harga="35000">KA003 - Jilbab</option>
                    <option value="KA004" data-nama="Sepatu" data-harga="150000">KA004 - Sepatu</option>
                    <option value="KA005" data-nama="Jeket" data-harga="85000">KA005 - Jeket</option>
                </select>
            </div>

            <div class="col-md-12 mt-3">
                <label class="fw-bold">Nama Barang</label>
                <input type="text" id="nama" class="form-control" placeholder="Masukkan Nama Barang" readonly>
            </div>

            <div class="col-md-12 mt-3">
                <label class="fw-bold">Harga</label>
                <input type="number" id="harga" class="form-control" placeholder="Masukkan Harga" readonly>
            </div>

            <div class="col-md-12 mt-3">
                <label class="fw-bold">Jumlah</label>
                <input type="number" id="jumlah" class="form-control" placeholder="Masukkan Jumlah">
            </div>

            <div class="col-md-12 mt-4">
                <button class="btn btn-primary" onclick="tambah()">Tambahkan</button>
                <button type="button" class="btn btn-light ms-2" onclick="clearInputs()">Batal</button>
            </div>
        </div>

        <hr>

        <!-- DAFTAR PEMBELIAN -->
        <h5 class="text-center fw-bold mt-4 mb-3">Daftar Pembelian</h5>

        <table class="table table-bordered text-center" id="tabel">
            <thead class="table-light">
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>

        <!-- RINGKASAN TOTAL -->
        <div class="text-end mt-4">
            <div>Total Belanja : <strong id="total-belanja">Rp 0</strong></div>
            <div>Diskon : <strong id="diskon">Rp 0 (5%)</strong></div>
            <div class="fs-5 mt-1">Total Bayar : <strong id="total-bayar">Rp 0</strong></div>
        </div>

        <button class="btn btn-outline-danger mt-4" onclick="kosongkan()">Kosongkan Keranjang</button>
    </div>
</div>

<script>
    let keranjang = [];

    function formatRupiah(num) {
        return "Rp " + num.toLocaleString("id-ID");
    }

    /* ------------------------------
        AUTO FILL NAMA & HARGA
    ------------------------------ */
    document.getElementById("kode").addEventListener("change", function () {
        let selected = this.options[this.selectedIndex];
        let nama = selected.getAttribute("data-nama");
        let harga = selected.getAttribute("data-harga");
        document.getElementById("nama").value = nama || "";
        document.getElementById("harga").value = harga || "";
    });

    function render() {
        const tbody = document.getElementById("tbody");
        tbody.innerHTML = "";
        let totalBelanja = 0;
        keranjang.forEach(item => {
            let total = item.harga * item.jumlah;
            totalBelanja += total;
            tbody.innerHTML += `
                <tr>
                    <td>${item.kode}</td>
                    <td>${item.nama}</td>
                    <td>${formatRupiah(item.harga)}</td>
                    <td>${item.jumlah}</td>
                    <td>${formatRupiah(total)}</td>
                </tr>
            `;
        });
        let diskon = totalBelanja * 0.05;
        let totalBayar = totalBelanja - diskon;
        document.getElementById("total-belanja").innerText = formatRupiah(totalBelanja);
        document.getElementById("diskon").innerText = `${formatRupiah(diskon)} (5%)`;
        document.getElementById("total-bayar").innerText = formatRupiah(totalBayar);
    }

    function tambah() {
        const kode = document.getElementById("kode").value;
        const nama = document.getElementById("nama").value;
        const harga = parseInt(document.getElementById("harga").value);
        const jumlah = parseInt(document.getElementById("jumlah").value);
        if (!kode || !nama || !harga || !jumlah) {
            alert("Semua field harus diisi!");
            return;
        }
        keranjang.push({ kode, nama, harga, jumlah });
        render();
    }

    function clearInputs() {
        document.getElementById('kode').value = '';
        document.getElementById('nama').value = '';
        document.getElementById('harga').value = '';
        document.getElementById('jumlah').value = '';
    }

    function kosongkan() {
        keranjang = [];
        render();
    }
</script>

</body>
</html>
