<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $item = [
        'name' => $_POST['menu_id'],
        'price' => $_POST['menu_price'],
        'image' => $_POST['menu_image'],
        'quantity' => 1 
    ];

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

if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    array_splice($_SESSION['cart'], $index, 1);
}

if (isset($_GET['minus'])) {
    $index = $_GET['minus'];
    if ($_SESSION['cart'][$index]['quantity'] > 1) {
        $_SESSION['cart'][$index]['quantity']--;
    } else {
        array_splice($_SESSION['cart'], $index, 1);
    }
}

if (isset($_GET['plus'])) {
    $index = $_GET['plus'];
    $_SESSION['cart'][$index]['quantity']++;
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
                    <a href="keranjang.php" class="flex items-center hover:text-[#d4a484] transition">
                 <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                    <span id="cart-count" class="bg-red-500 text-white text-xs rounded-full px-2 ml-2">
                <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                    </span>
                </a>
                <a href="login.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
        </div>
    </div>
</nav>

<div class="container mx-auto pt-24 px-4">
    <h1 class="text-4xl font-bold text-center mb-8">Keranjang Belanja</h1>
<?php if (empty($_SESSION['cart'])): ?>
        <p class="text-center text-xl mb-4">Keranjang Anda kosong.</p>
        
        <div class="flex justify-center mt-4">
            <form action="menu.php" method="GET">
                <button type="submit" class="bg-red-500 text-white px-8 py-3 rounded-lg hover:bg-red-600 transition-all duration-300 ease-in-out transform hover:scale-105 flex items-center">
                    <i class="fas fa-shopping-cart mr-2"></i> Yuk Mulai Belanja!!
                </button>
            </form>
        </div>
        
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
                    <div class="flex space-x-4 items-center">
                        <form action="keranjang.php" method="GET" class="flex items-center">
                            <input type="hidden" name="minus" value="<?= $index ?>">
                            <button type="submit" class="bg-gray-300 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-md hover:bg-[#FF4500] transition-all duration-300 ease-in-out transform hover:scale-110 minus-btn" data-quantity="<?= $item['quantity'] ?>">
                                <span class="text-2xl">-</span>
                            </button>
                        </form>

                        <span class="text-lg font-semibold mx-4"><?= $item['quantity'] ?></span>

                        <form action="keranjang.php" method="GET" class="flex items-center">
                            <input type="hidden" name="plus" value="<?= $index ?>">
                            <button type="submit" class="bg-gray-300 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-md hover:bg-[#28a745] transition-all duration-300 ease-in-out transform hover:scale-110 plus-btn" data-quantity="<?= $item['quantity'] ?>">
                                <span class="text-2xl">+</span>
                            </button>
                        </form>

                        <form action="keranjang.php" method="GET">
                            <input type="hidden" name="remove" value="<?= $index ?>">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 ease-in-out transform hover:scale-105 justify-center flex items-center">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
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
