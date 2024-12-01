<?php
// Simulasi jumlah stempel berdasarkan total pembayaran
// Misalnya, setiap pembelian menghasilkan 1 stempel
$total_stamps = 10; // Total stempel yang diperlukan
$current_stamps = 4; // Jumlah stempel saat ini (simulasi dari pembayaran)

// Hitung sisa stempel yang harus dikumpulkan
$stamps_needed = $total_stamps - $current_stamps;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Rewards</title>
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

        .next-action a {
            padding: 15px 30px;
            background-color: #8b4513;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .next-action a:hover {
            background-color: #5d2d00;
        }
    </style>
</head>
<body>
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