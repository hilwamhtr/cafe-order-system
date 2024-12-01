<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php';
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    $emailCheckStmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $emailCheckStmt->bind_param("s", $email);
    $emailCheckStmt->execute();
    $emailCheckStmt->store_result();

    if ($emailCheckStmt->num_rows > 0) {
        $error = "Email sudah terdaftar, coba dengan email lain!";
        $emailCheckStmt->close();
    } else {
        
        $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            
            header("Location: login.php");
            exit; 
        } else {
            
            $error = "Pendaftaran gagal, coba lagi!";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - KopiKita</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #6f4e37, #d7ccc8);
      color: #4E342E;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #ffffff;
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      width: 360px; 
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    h1 {
      color: #6f4e37;
      font-size: 26px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .input-group {
      margin-bottom: 15px;
      text-align: left;
    }

    label {
      display: block;
      font-weight: bold;
      color: #6f4e37;
      margin-bottom: 5px;
    }

    input {
      width: calc(100% - 20px); 
      padding: 10px;
      border: 1px solid #d7ccc8;
      border-radius: 8px;
      background-color: #f9f9f9;
      color: #4E342E;
      font-size: 14px;
      transition: border-color 0.3s ease;
      box-sizing: border-box;
    }

    input:focus {
      border-color: #6f4e37;
      outline: none;
    }

    .btn {
      background: #6f4e37;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%; 
      font-weight: bold;
      font-size: 16px;
      transition: background-color 0.3s ease;
      margin-top: 10px;
      box-sizing: border-box;
    }

    .btn:hover {
      background-color: #8d6e63;
    }

    .redirect-text {
      color: #6f4e37;
      font-size: 14px;
      margin-top: 15px;
    }

    .redirect-text a {
      color: #d7ccc8;
      font-weight: bold;
      text-decoration: none;
    }

    .redirect-text a:hover {
      text-decoration: underline;
    }

    .error {
      color: #e57373;
      margin-bottom: 10px;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .container {
        width: 100%;
        padding: 20px;
      }
      h1 {
        font-size: 22px;
      }
    }
  </style>
  <script>
    
    const form = document.querySelector("form");
    form.addEventListener("submit", function(e) {
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      if (name === "" || email === "" || password === "") {
        alert("Semua kolom harus diisi!");
        e.preventDefault(); 
      }
    });
  </script>
</head>
<body>
  <div class="container">
    <h1>KopiKita</h1>
    <?php if (isset($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="input-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn">Daftar</button>
    </form>
    <div class="redirect-text">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
  </div>
</body>
</html>
