<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php'; // Pastikan file ini sudah ada dan terkoneksi ke database
    $email = trim($_POST['email']); // Membersihkan input
    $password = trim($_POST['password']);
    
    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT id, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Periksa apakah email ada di database
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id; // Simpan user ID ke session
            header("Location: webcafe.php"); // Redirect ke webcafe.html
            exit; // Hentikan eksekusi setelah redirect
        } else {
            $error = "Password salah. Coba lagi.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - KopiKita</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #FFEBEE;
      color: #4E342E;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background-color: #4E342E;
      padding: 30px;
      border-radius: 8px;
      text-align: center;
      width: 320px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }
    h1 {
      color: #FFEBEE;
      font-size: 24px;
      margin-bottom: 20px;
    }
    .input-group {
      margin-bottom: 15px;
      text-align: left;
    }
    label {
      display: block;
      font-weight: bold;
      color: #D7CCC8;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #D7CCC8;
      border-radius: 4px;
      background-color: #6D4C41;
      color: #FFEBEE;
    }
    input::placeholder {
      color: #D7CCC8;
    }
    .btn {
      background-color: #FFEBEE;
      color: #4E342E;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-weight: bold;
    }
    .btn:hover {
      background-color: #D7CCC8;
    }
    .redirect-text {
      color: #FFEBEE;
      font-size: 14px;
      margin-top: 15px;
    }
    .redirect-text a {
      color: #FFCDD2;
      font-weight: bold;
      text-decoration: none;
    }
    .redirect-text a:hover {
      text-decoration: underline;
    }
    .error {
      color: #FFCDD2;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>KopiKita</h1>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <p class="redirect-text">Belum punya akun? <a href="register.php">Daftar</a></p>
  </div>
</body>
</html>
