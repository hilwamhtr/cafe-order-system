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
    $index = $_GET['remove'];
    array_splice($_SESSION['cart'], $index, 1);
}

// Untuk pesan sekarang, bisa langsung diarahkan ke halaman checkout
if (isset($_POST['order_now'])) {
    // Implementasi checkout atau pemesanan langsung
    // Redirect atau tindakan lainnya
    header("Location: pesanansaya.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Kopi Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f1de] text-[#3d405b]">

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Kopi Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                <a href="#rewards" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-award mr-2"></i> Rewards
                </a>
                <a href="keranjang.php" class="flex items-center hover:text-[#d4a484] transition">
                <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                </a>
                <a href="login.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

<!-- Keranjang Section -->
<div class="container mx-auto pt-24 px-4">
    <h1 class="text-4xl font-bold text-center mb-8">Keranjang Belanja</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="text-center text-xl">Keranjang Anda kosong.</p>
    <?php else: ?>
        <div class="space-y-8">
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all">
                <div class="flex items-center space-x-6">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-32 h-32 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="text-2xl font-semibold"><?= $item['name'] ?></h3>
                        <p class="text-gray-600 text-lg">Rp. <?= number_format($item['price'], 0, ',', '.') ?></p>
                        <p class="text-gray-500 text-sm">Jumlah: <?= $item['quantity'] ?></p>
                    </div>
                    <div>
                        <form action="keranjang.php" method="GET">
                            <input type="hidden" name="remove" value="<?= $index ?>">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-400 transition">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8 text-center space-y-4">
            <a href="pesanansaya.php" class="bg-[#6f4e37] text-white px-8 py-3 rounded-lg hover:bg-[#d4a484] transition block w-full sm:w-auto mx-auto text-lg">
                <i class="fas fa-credit-card mr-2"></i> Checkout
            </a>
            <a href="menu.php" class="bg-[#d4a484] text-white px-8 py-3 rounded-lg hover:bg-[#6f4e37] transition block w-full sm:w-auto mx-auto text-lg">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Menu
            </a>
        </div>
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