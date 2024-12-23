<?php
session_start();
$total_stamps = 10;

$current_stamps = isset($_SESSION['current_stamps']) ? $_SESSION['current_stamps'] : 0;
$stamps_needed = $total_stamps - $current_stamps;

if (!isset($_SESSION['current_stamps'])) {
    $_SESSION['current_stamps'] = 0; 
}

$total_stamps = 10;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['current_stamps']++; 
}

$current_stamps = $_SESSION['current_stamps'];
$stamps_needed = $total_stamps - $current_stamps;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f1e1;
            color: #333;
        }

        .reward-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            color: #8b4513;
            margin-bottom: 20px;
        }

        .stamps {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }

        .stamp {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #fff;
            border: 3px solid #8b4513;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            color: #8b4513;
        }

        .stamp.filled {
            background-color: #8b4513;
            color: white;
        }

        .message {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .next-action a,
        .next-action button {
            padding: 15px 30px;
            background-color: #8b4513;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .next-action a:hover,
        .next-action button:hover {
            background-color: #5d2d00;
        }

        form {
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-[#f4f1de] text-[#3d405b]">

    <!-- Navigasi -->
    <nav class="bg-[#6f4e37] fixed w-full z-50 shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-2xl font-bold text-white">KOPI KITA</div>
            <div class="flex space-x-6 text-white">
                <a href="index.php" class="flex items-center hover:text-[#d4a484] transition">
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
                <a href="logout.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="reward-container">
    <h1 class="text-4xl font-bold text-center mb-8">Stempel Rewards</h1>
        <div class="stamps">
            <?php
            for ($i = 1; $i <= $total_stamps; $i++) {
                if ($i <= $current_stamps) {
                    echo '<div class="stamp filled">' . $i . '</div>';
                } else {
                    echo '<div class="stamp"></div>';
                }
            }
            ?>
        </div>

        <div class="message">
            <?php if ($stamps_needed > 0): ?>
                <p>Belum cukup stempelnya? Kamu butuh <?= $stamps_needed ?> lagi untuk dapatkan hadiah!</p>
            <?php else: ?>
                <p>Selamat! Kamu sudah mengumpulkan semua stempel dan mendapatkan hadiah berupa potongan 50% di pembelian berikutnya!</p>
            <?php endif; ?>
        </div>

        <div class="next-action">
            <?php if ($stamps_needed > 0): ?>
                <a href="menu.php">Ayo Mulai Pesan Lagi</a>
            <?php else: ?>
                <a href="claim_reward.php">Klaim Hadiah</a>
            <?php endif; ?>
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
