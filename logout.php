<?php
// Memulai sesi
session_start();

// Menghapus semua data sesi
session_unset();

// Mengakhiri sesi
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header("Location: login.php");
exit();
?>
