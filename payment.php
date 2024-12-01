<?php
session_start();

if (!isset($_SESSION['rewards'])) {
    $_SESSION['rewards'] = 0; 
}

function tambahStempel() {
    if (!isset($_SESSION['current_stamps'])) {
        $_SESSION['current_stamps'] = 0;
    }
    $_SESSION['current_stamps']++; // Tambah stempel
}

$pembayaran_berhasil = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $paymentMethod = htmlspecialchars(trim($_POST['payment-method']));
    $bank = isset($_POST['bank']) ? htmlspecialchars(trim($_POST['bank'])) : null;
    $nomorRekening = isset($_POST['nomor-rekening']) ? htmlspecialchars(trim($_POST['nomor-rekening'])) : null;
    $nomorVA = isset($_POST['nomor-va']) ? htmlspecialchars(trim($_POST['nomor-va'])) : null;
    $jumlah = htmlspecialchars(trim($_POST['jumlah']));

    if ($paymentMethod === 'transfer_bank') {
        if (!$bank || !$nomorRekening) {
            $pesan = "Silakan pilih bank dan masukkan nomor rekening.";
        } else {
            $pesan = "Pembayaran sebesar Rp $jumlah berhasil diproses melalui Transfer Bank ($bank). Terima kasih, $nama!";
            $_SESSION['rewards']++; 
            $pembayaran_berhasil = true; 
        }
    } elseif (in_array($paymentMethod, ['shopeepay', 'dana', 'ovo', 'gopay'])) {
        if (!$nomorVA) {
            $pesan = "Silakan masukkan nomor Virtual Account.";
        } else {
            $pesan = "Pembayaran sebesar Rp $jumlah berhasil diproses melalui " . ucfirst($paymentMethod) . ". Terima kasih, $nama!";
            $_SESSION['rewards']++; 
            $pembayaran_berhasil = true; 
        }
    } elseif ($paymentMethod === 'cod') {
        $pesan = "Pesanan Anda akan dibayar saat pengantaran (COD). Terima kasih, $nama!";
        $_SESSION['rewards']++; 
        $pembayaran_berhasil = true; 
    } else {
        $pesan = "Harap lengkapi semua data pembayaran.";
    }
}

$diskonPesan = '';
if ($_SESSION['rewards'] >= 10) {
    $diskonPesan = "Selamat! Anda telah mengumpulkan 10 rewards. Anda mendapatkan potongan 50% untuk pembelian berikutnya!";
    $_SESSION['rewards'] = 0; 
}

if ($pembayaran_berhasil) {
    tambahStempel();

    header('Location: rewards.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>PAYMENT KOPI KITA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c1607;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #e6dfd9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], 
        input[type="number"], 
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button[type="submit"], .rewards-btn {
            width: 100%;
            background-color: #87460d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        button[type="submit"]:hover, .rewards-btn:hover {
            background-color: #5d89ca;
        }

        input:focus, select:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        .result {
            margin-top: 20px; 
            text-align: center; 
            color: green; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PAYMENT KOPI KITA</h1>

        <?php if (!$pembayaran_berhasil): ?>
            <form id="payment-form" method="POST">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>

                <label for="payment-method">Metode Pembayaran</label>
                <select id="payment-method" name="payment-method" onchange="showPaymentOptions(this.value)" required>
                    <option value="">-Pilih Metode Pembayaran-</option>
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="shopeepay">ShopeePay</option>
                    <option value="dana">Dana</option>
                    <option value="ovo">OVO</option>
                    <option value="gopay">GoPay</option>
                    <option value="cod">COD</option>
                </select>

                <div id="bank-selection" style="display:none;">
                    <label for="bank">Pilih Bank:</label>
                    <select id="bank" name="bank" onchange="showAccountInput(this.value)">
                        <option value="">-Pilih Bank-</option>
                        <option value="bca">BCA</option>
                        <option value="bni">BNI</option>
                        <option value="mandiri">Mandiri</option>
                        <option value="bri">BRI</option>
                    </select>
                </div>

                <div id="account-input" style="display:none;">
                    <label for="nomor-rekening">Nomor Rekening</label>
                    <input type="text" id="nomor-rekening" name="nomor-rekening">
                </div>

                <div id="virtual-account-input" style="display:none;">
                    <label for="nomor-va">Nomor Virtual Account</label>
                    <input type="text" id="nomor-va" name="nomor-va">
                </div>

                <label for="jumlah">Jumlah Pembayaran</label>
                <input type="number" id="jumlah" name="jumlah" required>

                <button type="submit">Bayar</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        function showPaymentOptions(method) {
            const bankSelection = document.getElementById("bank-selection");
            const accountInput = document.getElementById("account-input");
            const virtualAccountInput = document.getElementById("virtual-account-input");

            bankSelection.style.display = method === "transfer_bank" ? "block" : "none";
            accountInput.style.display = method === "transfer_bank" && document.getElementById("bank").value ? "block" : "none";
            virtualAccountInput.style.display = method === "shopeepay" || method === "dana" || method === "ovo" || method === "gopay" ? "block" : "none";
        }

        function showAccountInput(bank) {
            document.getElementById("account-input").style.display = bank ? "block" : "none";
        }
    </script>
</body>
</html>
