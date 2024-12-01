<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Menambah item ke keranjang
if (isset($_POST['add_to_cart'])) {
    $item = [
        'name' => $_POST['menu_id'],
        'price' => $_POST['menu_price'],
        'image' => $_POST['menu_image'],
        'quantity' => 1 // default quantity adalah 1
    ];

    // Cek jika item sudah ada di keranjang, jika ada tambahkan jumlahnya
    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['name'] == $item['name']) {
            $cartItem['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
}

// Menghapus item dari keranjang
if (isset($_GET['remove'])) {
    $index = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
    }
}

// Hitung ulang total barang dan total harga
$total_items = 0;
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_items += $item['quantity'];
    $total_price += $item['price'] * $item['quantity'];
}

// Menangani proses checkout
if (isset($_POST['checkout'])) {
    $delivery_method = $_POST['delivery_method'];

    if ($delivery_method === "delivery") {
        $address = $_POST['delivery_address'];
        // Validasi atau proses pengiriman
    } elseif ($delivery_method === "pickup") {
        $pickup_date = $_POST['pickup_date'];
        $pickup_time = $_POST['pickup_time'];
        // Validasi atau proses pickup
    }

    // Proses simpan pesanan
    header("Location: checkout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Kopi Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        function toggleFields(value) {
            document.getElementById('delivery_fields').style.display = value === 'delivery' ? 'block' : 'none';
            document.getElementById('pickup_fields').style.display = value === 'pickup' ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-[#f4f1de] text-[#3d405b]">

    <!-- Navigasi -->
    <nav class="bg-[#6f4e37] fixed w-full z-50 shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-2xl font-bold text-white">KOPI KITA</div>
            <div class="flex space-x-6 text-white">
                <a href="webcafe.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-home mr-2"></i> Beranda
                </a>
                <a href="menu.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-coffee mr-2"></i> Menu
                </a>
                <a href="pesanansaya.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-shopping-cart mr-2"></i> Pesanan Saya
                </a>
                <a href="rewards.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-award mr-2"></i> Rewards
                </a>
                <a href="keranjang.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                 <span id="cart-count" class="bg-red-500 text-white text-xs rounded-full px-2 ml-2">0</span>
                </a>
                <a href="login.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
    </div>
</nav>

<!-- Pesanan Section -->
<div class="container mx-auto pt-24 px-4">
    <h1 class="text-4xl font-bold text-center mb-8">Pesanan Saya</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="text-center text-xl">Belum ada pesanan.</p>
    <?php else: ?>
        <div class="space-y-8">
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between space-x-6">
                        <div class="flex items-center space-x-6">
                            <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-32 h-32 object-cover rounded-lg">
                            <div>
                                <h3 class="text-2xl font-semibold"><?= $item['name'] ?></h3>
                                <p>Rp. <?= number_format($item['price'], 0, ',', '.') ?></p>
                                <p>Jumlah: <?= $item['quantity'] ?></p>
                            </div>
                        </div>
                        <!-- Tombol hapus di sisi kanan -->
                        <form action="pesanansaya.php" method="GET">
                            <input type="hidden" name="remove" value="<?= $index ?>">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-400 transition">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Form Pilihan Pengiriman -->
        <form action="pesanansaya.php" method="POST" class="mt-8">
            <div class="mb-4">
                <label for="delivery_method" class="block font-bold mb-2">Pilih Metode Pengambilan:</label>
                <select name="delivery_method" id="delivery_method" class="w-full p-3 rounded-lg" onchange="toggleFields(this.value)">
                    <option value="delivery">Delivery</option>
                    <option value="pickup">Pickup</option>
                </select>
            </div>

            <div id="delivery_fields" class="mb-4">
                <label for="delivery_address" class="block font-bold mb-2">Alamat Pengiriman:</label>
                <input type="text" name="delivery_address" id="delivery_address" class="w-full p-3 rounded-lg" placeholder="Masukkan alamat pengiriman">
            </div>

            <div id="pickup_fields" class="mb-4 hidden">
                <label for="pickup_date" class="block font-bold mb-2">Tanggal Pickup:</label>
                <input type="date" name="pickup_date" id="pickup_date" class="w-full p-3 rounded-lg">
                <label for="pickup_time" class="block font-bold mb-2 mt-4">Jam Pickup:</label>
                <input type="time" name="pickup_time" id="pickup_time" class="w-full p-3 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block font-bold mb-2">Metode Pembayaran:</label>
                <select name="payment_method" id="payment_method" class="w-full p-3 rounded-lg">
                    <option value="bank">Bank Transfer</option>
                    <option value="spay">ShopeePay</option>
                    <option value="gopay">GoPay</option>
                    <option value="ovo">OVO</option>
                    <option value="cash">Cash</option>
                </select>
            </div>

            <p class="text-lg font-bold mb-4">Total Pesanan: <?= $total_items ?> item - Rp. <?= number_format($total_price, 0, ',', '.') ?></p>

            <div class="flex space-x-4">
                <a href="menu.php" class="bg-[#d4a484] text-white px-4 py-2 rounded-lg hover:bg-[#6f4e37]">Kembali ke Menu</a>
                <button type="submit" name="checkout" class="bg-[#6f4e37] text-white px-4 py-2 rounded-lg hover:bg-[#d4a484]">Checkout</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<!-- Footer -->
<footer class="bg-[#6f4e37] text-white py-12 mt-16">
    <div class="container mx-auto grid md:grid-cols-3 gap-8 text-center">
        <div>
            <h3 class="text-xl font-bold mb-4">Kontak</h3>
            <p>Email: info@kopikita.com</p>
            <p>Telepon: (021) 123-4567</p>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-4">Jam Buka</h3>
            <p>Senin - Jumat: 07:00 - 22:00</p>
            <p>Sabtu - Minggu: 08:00 - 23:00</p>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-4">Media Sosial</h3>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-[#d4a484]">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <a href="#" class="hover:text-[#d4a484]">
                    <i class="fab fa-facebook"></i> Facebook
                </a>
                <a href="#" class="hover:text-[#d4a484]">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
