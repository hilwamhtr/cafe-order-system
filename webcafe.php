<?php
$menuCategories = ['Semua', 'Kopi', 'Non-Kopi', 'Dessert'];
$menuItems = [
    [
        'name' => 'Cafe Latte',
        'description' => 'Espresso dengan steamed milk yang lembut',
        'price' => 28000,
        'image' => 'https://via.placeholder.com/400x300'
    ],
    [
        'name' => 'Cappuccino',
        'description' => 'Espresso dengan foam susu yang tebal',
        'price' => 17000,
        'image' => 'https://via.placeholder.com/400x300'
    ],
    [
        'name' => 'Thai Tea',
        'description' => 'Teh susu dari Thailand yang creamy',
        'price' => 16000,
        'image' => 'https://via.placeholder.com/400x300'
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Kita</title>
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
                <a href="rewards.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-award mr-2"></i> Rewards
                </a>
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

    <header class="h-screen bg-center flex items-center justify-center" 
        style="background: linear-gradient(rgba(62, 39, 35, 0.8), rgba(62, 39, 35, 0.8)),
                url('/api/placeholder/1200/600');
                background-size: cover;
                background-position: center;
                color: #FFF8E1;">
    <div class="text-center text-white bg-[#4D3636] bg-opacity-50 p-10 rounded-xl">
        <h1 class="text-5xl font-bold mb-4 text-white">Selamat Datang di Kopi Kita</h1>
        <p class="text-xl mb-6">Nikmati kemudahan memesan dan pembayaran digital melalui perangkat anda</p>
        <a href="menu.php" class="bg-[#6F4E37] text-white px-6 py-3 rounded-full hover:bg-[#D4A484] transition">
            Mulai Pesan        
        </a>
    </div>
</header>

<section class="bg-[#e2d6c1] py-20 px-6 md:px-16">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-12 text-[#6F4E37]">Kenapa Harus Kopi Kita?</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="feature-card bg-white p-8 rounded-xl shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-coffee text-[#6F4E37] text-5xl mb-6"></i>
                <h3 class="text-2xl font-semibold mb-4 text-[#6F4E37]">Kopi yang Selalu Menggoda</h3>
                <p class="text-gray-600">Rasakan kenikmatan kopi berkualitas setiap tegukan!</p>
            </div>
            <div class="feature-card bg-white p-8 rounded-xl shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-map-marker-alt text-[#6F4E37] text-5xl mb-6"></i>
                <h3 class="text-2xl font-semibold mb-4 text-[#6F4E37]">Lokasi Strategis & Nyaman</h3>
                <p class="text-gray-600">Kami hadir di tempat yang mudah dijangkau, nyaman untuk bersantai atau bekerja.</p>
            </div>
            <div class="feature-card bg-white p-8 rounded-xl shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-clock text-[#6F4E37] text-5xl mb-6"></i>
                <h3 class="text-2xl font-semibold mb-4 text-[#6F4E37]">Waktu yang Fleksibel</h3>
                <p class="text-gray-600">Kami buka lebih lama, sehingga Anda bisa menikmati kopi kapan saja.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-[#e2d6c1] py-16 px-6 md:px-16">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-12 text-[#6F4E37]">Apa Kata Mereka?</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="testimony-card bg-white p-8 rounded-xl shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-star text-yellow-500 text-4xl mb-6"></i>
                <p class="mb-6 italic">"Gokil minum kopi di sini bikin ketagihan"</p>
                <h4 class="font-semibold text-[#6F4E37]">- Jake Sim</h4>
            </div>
            <div class="testimony-card bg-white p-8 rounded-xl shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-star text-yellow-500 text-4xl mb-6"></i>
                <p class="mb-6 italic">"Nyaman banget kalo mau minum kopi atau pesen cemilan di sini, pelayanannya cepet dan kualitasnya selalu oke"</p>
                <h4 class="font-semibold text-[#6F4E37]">- Jennie Kim</h4>
            </div>
            <div class="testimony-card bg-white p-8 rounded-xl shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-star text-yellow-500 text-4xl mb-6"></i>
                <p class="mb-6 italic">"Program rewards-nya keren! Dapat diskon setelah beberapa kali pembelian"</p>
                <h4 class="font-semibold text-[#6F4E37]">- Chanyeol Park</h4>
            </div>
        </div>
    </div>
</section>

    <footer class="bg-[#6f4e37] text-white py-12">
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
             <a href="https://www.instagram.com/imazinesyen/" class="hover:text-[#d4a484]">
                <i class="fab fa-instagram"></i> Instagram
        </a>
             <a href="https://www.facebook.com/CristianoRonaldo/" class="hover:text-[#d4a484]">
                <i class="fab fa-facebook"></i> Facebook
        </a>
            <a href="https://twitter.com/mfs_ub" class="hover:text-[#d4a484]">
                <i class="fab fa-twitter"></i> Twitter
        </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
