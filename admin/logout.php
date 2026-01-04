<?php
session_start(); // Memulai session untuk mengakses data yang tersimpan

// Menghapus semua variabel session
session_unset();

// Menghancurkan session sepenuhnya
session_destroy();

// Mengalihkan pengguna kembali ke halaman login
echo "<script>alert('Anda telah berhasil logout!'); window.location='login.php';</script>";
exit();
?>