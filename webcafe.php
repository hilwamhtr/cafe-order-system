<?php
// Data statis untuk menu
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
                <a href="#home" class="flex items-center hover:text-[#d4a484] transition">
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

    <!-- Hero Section -->
    <header class="h-screen bg-center flex items-center justify-center" 
        style="background: linear-gradient(rgba(62, 39, 35, 0.8), rgba(62, 39, 35, 0.8)),
                url('/api/placeholder/1200/600');
                background-size: cover;
                background-position: center;
                color: #FFF8E1;">
    <div class="text-center text-white bg-[#4D3636] bg-opacity-50 p-10 rounded-xl">
        <h1 class="text-5xl font-bold mb-4 text-white">Selamat Datang di Kopi Kita</h1>
        <p class="text-xl mb-6">Nikmati kemudahan memesan dan pembayaran digital melalui perangkat anda</p>
        <!-- Ubah tombol untuk mengarahkan ke menu.php -->
        <a href="menu.php" class="bg-[#6F4E37] text-white px-6 py-3 rounded-full hover:bg-[#D4A484] transition">
            Mulai Pesan        
        </a>
    </div>
</header>

    <!-- Fitur Unggulan -->
    <section class="container mx-auto py-16 px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Mengapa Memilih Kopi Kita?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <i class="fas fa-coffee text-[#6f4e37] text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Kopi Berkualitas</h3>
                <p>Kami menyajikan berbagai menu kopi dan dessert pilihan dari resep terbaik</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <i class="fas fa-map-marker-alt text-[#6f4e37] text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Lokasi Mudah</h3>
                <p>lokasi strategis karena ada di pusat kota</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <i class="fas fa-clock text-[#6f4e37] text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Buka Lama</h3>
                <p>Senin-Jumat: 07:00 - 22:00, Sabtu-Minggu: 08:00 - 23:00</p>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="bg-[#e2d6c1] py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-12">Apa Kata Mereka Tentang Kopi Kita</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-star text-yellow-500 text-2xl mb-4"></i>
                    <p class="mb-4 italic">"Kopi terenak yang pernah saya cicipi!"</p>
                    <h4 class="font-semibold">- Budi Santoso</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-star text-yellow-500 text-2xl mb-4"></i>
                    <p class="mb-4 italic">"Pelayanan ramah dan cepat"</p>
                    <h4 class="font-semibold">- Maria Kusuma</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-star text-yellow-500 text-2xl mb-4"></i>
                    <p class="mb-4 italic">"Rewards-nya keren banget!"</p>
                    <h4 class="font-semibold">- Ahmad Rifai</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
