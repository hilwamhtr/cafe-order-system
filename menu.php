<?php
// Data statis untuk menu
$menuCategories = ['Semua', 'Kopi', 'Non-Kopi', 'Dessert'];
$menuItems = [
    [
        'name' => 'Cafe Latte',
        'description' => 'Espresso dengan steamed milk yang lembut',
        'price' => 28000,
        'category' => 'Kopi',
        'image' => 'https://i.pinimg.com/474x/35/9f/c1/359fc15a59e47967f1e95305c7ae194e.jpg'
    ],
    [
        'name' => 'Cappuccino',
        'description' => 'Espresso dengan foam susu yang tebal',
        'price' => 17000,
        'category' => 'Kopi',
        'image' => 'https://i.pinimg.com/474x/aa/58/db/aa58db1f67f7a048ea74029c59bb6adb.jpg'
    ],
    [
        'name' => 'Americano',
        'description' => 'Espresso dengan tambahan air panas',
        'price' => 15000,
        'category' => 'Kopi',
        'image' => 'https://i.pinimg.com/736x/cb/48/db/cb48db04009801523739569e0f33cfc3.jpg'
    ],
    [
        'name' => 'Thai Tea',
        'description' => 'Teh susu dari Thailand yang creamy',
        'price' => 16000,
        'category' => 'Non-Kopi',
        'image' => 'https://i.pinimg.com/474x/2a/74/7d/2a747d0502b31ca988ccbb4b8ac9af84.jpg'
    ],
    [
        'name' => 'Lemon Squash',
        'description' => 'Minuman lemon yang menyegarkan',
        'price' => 18000,
        'category' => 'Non-Kopi',
        'image' => 'https://i.pinimg.com/474x/d8/30/a2/d830a224c35824f383249ca68b35cacb.jpg'
    ],
    [
        'name' => 'Matcha',
        'description' => 'Matcha asli jepang dengan rasa yang creamy',
        'price' => 20000,
        'category' => 'Non-Kopi',
        'image' => 'https://i.pinimg.com/474x/97/84/40/978440fe09d65d3d1c461e614bd150d5.jpg'
    ],
    [
        'name' => 'Strawberry MilkShake',
        'description' => 'MilkShake dengan rasa strawberry yang nyegerin',
        'price' => 23000,
        'category' => 'Non-Kopi',
        'image' => 'https://i.pinimg.com/474x/17/c3/b9/17c3b99dd8df04df5674e7619abcd807.jpg'
    ],
    [
        'name' => 'Vanilla MilkShake',
        'description' => 'MilkShake dengan rasa vanilla yang creamy banget!',
        'price' => 22000,
        'category' => 'Non-Kopi',
        'image' => 'https://i.pinimg.com/474x/fe/7d/55/fe7d55e005af26588e58ee4b21b4806f.jpg'
    ],
    [
        'name' => 'Chocolate Brownie',
        'description' => 'Brownies cokelat lembut dengan taburan kacang',
        'price' => 25000,
        'category' => 'Dessert',
        'image' => 'https://i.pinimg.com/474x/bb/16/00/bb1600ca1db254f511ee0c3773715df7.jpg'
    ],
    [
        'name' => 'American Pancake',
        'description' => 'Pancake khas Amerika dgn maple syrup',
        'price' => 30000,
        'category' => 'Dessert',
        'image' => 'https://i.pinimg.com/474x/6a/4b/f8/6a4bf8fa226bb9ea4832695b403f3ae2.jpg'
    ],
    [
        'name' => 'Burnt Cheesecake Brownies',
        'description' => 'Chesecake lumer dengan layer brownies',
        'price' => 50000,
        'category' => 'Dessert',
        'image' => 'https://i.pinimg.com/474x/2c/3b/ac/2c3baca047623f96c8d8ff1b150039af.jpg'
    ],
    [
        'name' => 'Lava Cakes',
        'description' => 'Cake coklat lembut dengan coklat yang meleleh saat dipotong',
        'price' => 32700,
        'category' => 'Dessert',
        'image' => 'https://i.pinimg.com/474x/01/63/eb/0163ebec866f5665dc136e16b9a6c61f.jpg'
    ],
    [
        'name' => 'Tiramisu Cake',
        'description' => 'Cake Tiramisu yang creamy dan ngopi banget!',
        'price' => 35000,
        'category' => 'Dessert',
        'image' => 'https://i.pinimg.com/474x/b7/46/ee/b746ee2653c180da2c34f6cfb3df2570.jpg'
    ],
    [
        'name' => 'Cookie Butter Biscoff Brownies',
        'description' => 'Fudgy brownie dengan selai biscoff ditengahnya',
        'price' => 45000,
        'category' => 'Dessert',
        'image' => 'https://i.pinimg.com/474x/1f/6b/ca/1f6bca9e6746f4dd59b38d247a9c063e.jpg'
    ],
];

// Fungsi untuk filter menu berdasarkan kategori
function filterMenu($category, $items) {
    if ($category == 'Semua') {
        return $items;
    }
    return array_filter($items, function($item) use ($category) {
        return $item['category'] == $category;
    });
}

// Kategori yang aktif (default 'Semua')
$activeCategory = isset($_GET['category']) ? $_GET['category'] : 'Semua';
$filteredMenuItems = filterMenu($activeCategory, $menuItems);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Kopi Kita</title>
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
                <a href="#keranjang" class="flex items-center hover:text-[#d4a484] transition">
                <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                </a>
                <a href="logout.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Menu Section -->
    <div class="container mx-auto pt-24 px-4">
        <h1 class="text-4xl font-bold text-center mb-8">Menu Kopi Kita</h1>
        
        <!-- Kategori Menu -->
        <div class="flex justify-center mb-8 space-x-4">
            <?php foreach($menuCategories as $category): ?>
                <a href="?category=<?= urlencode($category) ?>" 
                   class="px-4 py-2 rounded-full <?= $activeCategory == $category ? 'bg-[#6f4e37] text-white' : 'bg-white text-[#6f4e37] border border-[#6f4e37]' ?> hover:bg-[#6f4e37] hover:text-white transition">
                    <?= $category ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
    <?php foreach($filteredMenuItems as $item): ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Gambar dengan ukuran 300x400 -->
            <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" 
                 style="width: 300px; height: 400px; object-fit: cover; display: block; margin: auto;">
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-2"><?= $item['name'] ?></h3>
                <p class="text-gray-600 mb-4"><?= $item['description'] ?></p>
                <div class="flex justify-between items-center">
                    <span class="text-[#6f4e37] font-bold">Rp. <?= number_format($item['price'], 0, ',', '.') ?></span>
                </div>
                <!-- Tombol di bawah -->
                <div class="flex space-x-2 mt-4">
                    <button class="bg-[#6f4e37] text-white px-3 py-1.5 rounded-lg hover:bg-[#d4a484] transition flex-1 text-center">
                        Tambah ke Keranjang
                    </button>
                    <button class="bg-[#6f4e37] text-white px-3 py-1.5 rounded-lg hover:bg-[#d4a484] transition flex-1 text-center">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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