<?php
session_start();

// 1. CEK KONEKSI
// Jika koneksi.php ada di folder luar (sejajar dengan index.php), gunakan '../koneksi.php'
// Jika koneksi.php ada di folder yang SAMA dengan login.php, gunakan 'koneksi.php'
if (file_exists('../koneksi.php')) {
    include '../koneksi.php';
} elseif (file_exists('koneksi.php')) {
    include 'koneksi.php';
} else {
    die("Error: File koneksi.php tidak ditemukan! Cek path include.");
}

if (isset($_POST['login'])) {
    // Ambil data dari form (Pastikan name di HTML adalah 'username')
    $user_login = mysqli_real_escape_string($conn, $_POST['username']);
    $pass_login = mysqli_real_escape_string($conn, $_POST['password']);

    // --- CEK LOGIN ADMIN ---
    // Menggunakan data dari SQL Dump Anda: username='admin', password='admin123'
    $query_str = "SELECT * FROM admin WHERE username = '$user_login' AND password = '$pass_login'";
    $q_admin = mysqli_query($conn, $query_str);

    // Cek Error Query (Untuk debugging jika ada salah ketik nama tabel)
    if (!$q_admin) {
        die("Query Error: " . mysqli_error($conn));
    }

    $cek_admin = mysqli_num_rows($q_admin);

    if ($cek_admin > 0) {
        // --- JIKA LOGIN BERHASIL ---
        $data = mysqli_fetch_assoc($q_admin);

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['nama']    = $data['nama_lengkap'];
        $_SESSION['level']   = 'admin';

        $_SESSION['status'] = "login";
        // Pastikan file dashboard.php ada di folder yang sama dengan login.php
        header("Location: dashboard.php");
        exit();
    } else {
        // --- JIKA GAGAL ---
        echo "<script>
            alert('Username atau Password Salah!\\nSilakan coba lagi.');
            window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YPP Darunnadwah Al-Majidiyah</title>
    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="auth-body">

    <div class="glass-card">
        <h2>Special Admin</h2>
        <h3>Login</h3>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>

            <div class="btn-group-auth">
                <a href="../daftar.php" class="btn-back" style="text-align:center; text-decoration:none;">Kembali</a>
                <button type="submit" name="login" class="btn-submit">Login</button>
            </div>
        </form>
    </div>

</body>

</html>