<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLGAN MART - Sistem Penjualan Sederhana</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: var(--primary);
            color: white;
            padding: 15px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-danger {
            background-color: var(--accent);
            color: white;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .pos-container {
            display: none;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .pos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: var(--primary);
            color: white;
        }

        .pos-header h1 {
            font-size: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn {
            background: none;
            border: 1px solid white;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .pos-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 20px;
        }

        .input-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group label {
            font-weight: 600;
            color: var(--dark);
        }

        .input-group input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .button-group button {
            flex: 1;
        }

        .cart-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
        }

        .cart-section h2 {
            margin-bottom: 15px;
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
            padding-bottom: 8px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .cart-table th {
            background-color: var(--primary);
            color: white;
            padding: 12px;
            text-align: left;
        }

        .cart-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .cart-summary {
            background-color: #e8f4fc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-total {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .empty-cart-btn {
            width: 100%;
            margin-top: 15px;
        }

        .error-message {
            color: var(--accent);
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        @media (max-width: 768px) {
            .pos-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Login Form -->
    <div class="container">
        <div class="login-container" id="loginContainer">
            <header>
                <h1>POLGAN MART</h1>
                <p>Sistem Penjualan Sederhana</p>
            </header>
            <h2>Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Masukkan password" required>
                </div>
                <div class="error-message" id="loginError">
                    Username atau password salah!
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <!-- POS System -->
    <div class="container">
        <div class="pos-container" id="posContainer">
            <div class="pos-header">
                <h1>POLGAN MART - Sistem Penjualan</h1>
                <div class="user-info">
                    <span id="userDisplay">User: Admin</span>
                    <button class="logout-btn" id="logoutBtn">Logout</button>
                </div>
            </div>

            <div class="pos-content">
                <div class="input-section">
                    <div class="input-group">
                        <label for="productCode">Kode Barang</label>
                        <input type="text" id="productCode" placeholder="Masukkan Kode Barang">
                    </div>

                    <div class="input-group">
                        <label for="productName">Nama Barang</label>
                        <input type="text" id="productName" placeholder="Masukkan Nama Barang">
                    </div>

                    <div class="input-group">
                        <label for="productPrice">Harga</label>
                        <input type="number" id="productPrice" placeholder="Masukkan Harga">
                    </div>

                    <div class="input-group">
                        <label for="productQuantity">Jumlah</label>
                        <input type="number" id="productQuantity" placeholder="Masukkan Jumlah" value="1">
                    </div>

                    <div class="button-group">
                        <button class="btn btn-success" id="addBtn">Tambahkan</button>
                        <button class="btn btn-secondary" id="cancelBtn">Batal</button>
                    </div>
                </div>

                <div class="cart-section">
                    <h2>Daftar Pembelian</h2>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cartItems">
                            <!-- Cart items will be added here dynamically -->
                        </tbody>
                    </table>

                    <div class="cart-summary">
                        <div class="summary-row">
                            <span>Total Belanja</span>
                            <span id="totalAmount">Rp 0</span>
                        </div>
                        <div class="summary-row">
                            <span>Diskon</span>
                            <span id="discountAmount">Rp 0 (0%)</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total Bayar</span>
                            <span id="finalAmount">Rp 0</span>
                        </div>
                    </div>

                    <button class="btn btn-danger empty-cart-btn" id="emptyCartBtn">Kosongkan Keranjang</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Login credentials
        const validUsers = [
            { username: "admin", password: "123", },
        ];

        // Cart data
        let cart = [];

        // DOM Elements
        const loginContainer = document.getElementById('loginContainer');
        const posContainer = document.getElementById('posContainer');
        const loginForm = document.getElementById('loginForm');
        const loginError = document.getElementById('loginError');
        const logoutBtn = document.getElementById('logoutBtn');
        const userDisplay = document.getElementById('userDisplay');

        const productCode = document.getElementById('productCode');
        const productName = document.getElementById('productName');
        const productPrice = document.getElementById('productPrice');
        const productQuantity = document.getElementById('productQuantity');
        const addBtn = document.getElementById('addBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const cartItems = document.getElementById('cartItems');
        const totalAmount = document.getElementById('totalAmount');
        const discountAmount = document.getElementById('discountAmount');
        const finalAmount = document.getElementById('finalAmount');
        const emptyCartBtn = document.getElementById('emptyCartBtn');

        // Login functionality
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const user = validUsers.find(u => u.username === username && u.password === password);

            if (user) {
                // Login successful
                loginError.style.display = 'none';
                userDisplay.textContent = `User: ${user.name}`;
                loginContainer.style.display = 'none';
                posContainer.style.display = 'block';
            } else {
                // Login failed
                loginError.style.display = 'block';
            }
        });

        // Logout functionality
        logoutBtn.addEventListener('click', function() {
            loginContainer.style.display = 'block';
            posContainer.style.display = 'none';
            loginForm.reset();
            cart = [];
            updateCartDisplay();
        });

        // Add product to cart
        addBtn.addEventListener('click', function() {
            const code = productCode.value.trim();
            const name = productName.value.trim();
            const price = parseInt(productPrice.value);
            const quantity = parseInt(productQuantity.value);

            if (!code || !name || isNaN(price) || isNaN(quantity) || price <= 0 || quantity <= 0) {
                alert('Harap isi semua field dengan benar!');
                return;
            }

            // Check if product already exists in cart
            const existingItemIndex = cart.findIndex(item => item.code === code);

            if (existingItemIndex !== -1) {
                // Update existing item
                cart[existingItemIndex].quantity += quantity;
                cart[existingItemIndex].total = cart[existingItemIndex].price * cart[existingItemIndex].quantity;
            } else {
                // Add new item
                const total = price * quantity;
                cart.push({ code, name, price, quantity, total });
            }

            updateCartDisplay();
            clearInputs();
        });

        // Cancel button
        cancelBtn.addEventListener('click', clearInputs);

        // Empty cart
        emptyCartBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                cart = [];
                updateCartDisplay();
            }
        });

        // Update cart display
        function updateCartDisplay() {
            // Clear current cart display
            cartItems.innerHTML = '';

            // Calculate totals
            let subtotal = 0;

            // Add items to cart display
            cart.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.code}</td>
                    <td>${item.name}</td>
                    <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td>${item.quantity}</td>
                    <td>Rp ${item.total.toLocaleString('id-ID')}</td>
                `;
                cartItems.appendChild(row);

                subtotal += item.total;
            });

            // Calculate discount (5% if subtotal > 0)
            const discountRate = subtotal > 0 ? 0.05 : 0;
            const discount = subtotal * discountRate;
            const total = subtotal - discount;

            // Update summary
            totalAmount.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            discountAmount.textContent = `Rp ${discount.toLocaleString('id-ID')} (${discountRate * 100}%)`;
            finalAmount.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Clear input fields
        function clearInputs() {
            productCode.value = '';
            productName.value = '';
            productPrice.value = '';
            productQuantity.value = '1';
            productCode.focus();
        }

        // Initialize with example data
        window.addEventListener('DOMContentLoaded', function() {
            // Add example product to cart
            cart.push({
                code: 'KO01',
                name: 'Teh Pucuk',
                price: 3000,
                quantity: 1,
                total: 3000
            });

            updateCartDisplay();
        });
    </script>
</body>
</html>
