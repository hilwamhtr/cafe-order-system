<?php
session_start(); // Memulai sesi

// Inisialisasi jumlah stempel jika belum ada
if (!isset($_SESSION['current_stamps'])) {
    $_SESSION['current_stamps'] = 0; // Awal stempel adalah 0
}

// Total stempel yang diperlukan untuk mendapatkan hadiah
$total_stamps = 10;

// Proses penambahan stempel setiap kali pengguna melakukan checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['current_stamps']++; // Tambahkan 1 stempel
}

// Hitung jumlah stempel saat ini dan sisa yang dibutuhkan
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
        /* Reset Style */
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
<body class="bg-gray-100">
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
                <a href="login.php" class="flex items-center hover:text-[#d4a484] transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="reward-container">
        <h1>Stempel Rewards</h1>
        <div class="stamps">
            <?php
            // Loop untuk menampilkan 10 stempel
            for ($i = 1; $i <= $total_stamps; $i++) {
                // Jika stempel sudah diperoleh
                if ($i <= $current_stamps) {
                    echo '<div class="stamp filled">' . $i . '</div>';
                } else {
                    echo '<div class="stamp"></div>';
                }
            }
            ?>
        </div>

        <!-- Pesan -->
        <div class="message">
            <?php if ($stamps_needed > 0): ?>
                <p>Belum cukup stempelnya? Kamu butuh <?= $stamps_needed ?> lagi untuk dapatkan hadiah!</p>
            <?php else: ?>
                <p>Selamat! Kamu sudah mengumpulkan semua stempel dan mendapatkan hadiah!</p>
            <?php endif; ?>
        </div>

        <!-- Tombol aksi -->
        <div class="next-action">
            <?php if ($stamps_needed > 0): ?>
                <a href="menu.php">Ayo Mulai Pesan Lagi</a>
            <?php else: ?>
                <a href="claim_reward.php">Klaim Hadiah</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
