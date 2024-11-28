<?php
// Contoh data pesanan untuk testing
$orderItems = [
    [
        'name' => 'Cafe Latte',
        'quantity' => 2,
        'price' => 28000
    ],
    [
        'name' => 'Chocolate Brownie',
        'quantity' => 1,
        'price' => 25000
    ]
];

// Hitung total pesanan
$totalOrder = array_reduce($orderItems, function ($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Kopi Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js" defer></script>
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
                <a href="#keranjang" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                </a>
                <a href="login.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Pesanan Section -->
    <div class="container mx-auto pt-24 px-4">
        <h1 class="text-4xl font-bold text-center mb-8">Pesanan Saya</h1>

        <!-- Tabel Pesanan -->
        <div class="bg-white p-6 shadow-md rounded-lg mb-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">Nama Menu</th>
                        <th class="py-3 text-center">Jumlah</th>
                        <th class="py-3 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr class="border-b">
                            <td class="py-2"><?= $item['name'] ?></td>
                            <td class="py-2 text-center"><?= $item['quantity'] ?></td>
                            <td class="py-2 text-right">Rp. <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pilihan Pengambilan -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Pilih Cara Pengambilan</h2>
            <div x-data="{ pickup: true }">
                <div class="flex space-x-4 mb-4">
                    <button @click="pickup = true" class="px-6 py-3 rounded-lg" 
                            :class="pickup ? 'bg-[#6f4e37] text-white' : 'bg-white text-[#6f4e37] border border-[#6f4e37]'">
                        Pickup
                    </button>
                    <button @click="pickup = false" class="px-6 py-3 rounded-lg" 
                            :class="pickup ? 'bg-white text-[#6f4e37] border border-[#6f4e37]' : 'bg-[#6f4e37] text-white'">
                        Delivery
                    </button>
                </div>

                <!-- Pickup Info -->
                <div x-show="pickup" class="mt-4">
                    <label class="block mb-2 font-bold">Waktu Pickup</label>
                    <input type="time" class="w-full px-4 py-2 border rounded-lg mb-4">
                    <label class="block mb-2 font-bold">Tanggal Pickup</label>
                    <input type="date" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- Delivery Info -->
                <div x-show="!pickup" class="mt-4">
                    <label class="block mb-2 font-bold">Alamat Pengiriman</label>
                    <textarea class="w-full px-4 py-2 border rounded-lg" rows="3" placeholder="Masukkan alamat Anda"></textarea>
                </div>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Pilih Metode Pembayaran</h2>
            <select class="w-full px-4 py-3 border rounded-lg">
                <option value="bank">Transfer Bank</option>
                <option value="spay">ShopeePay</option>
                <option value="gopay">GoPay</option>
                <option value="ovo">OVO</option>
                <option value="cod">COD</option>
            </select>
        </div>

        <!-- Total Order -->
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold">Total Order</h3>
            <span class="text-2xl font-bold text-[#6f4e37]">Rp. <?= number_format($totalOrder, 0, ',', '.') ?></span>
        </div>

        <!-- Tombol Checkout -->
        <div class="mt-8 text-center">
            <a href="payment.php" class="bg-[#6f4e37] text-white px-6 py-3 rounded-lg hover:bg-[#d4a484] transition">
                Lanjutkan ke Pembayaran
            </a>
        </div>
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
