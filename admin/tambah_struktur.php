<?php
session_start();
include 'koneksi.php';

// Cek status login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);

    // Upload Foto
    $filename = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $nama_baru = "";

    // Cek jika ada file yang diupload
    if ($filename != "") {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_baru = rand(100, 999) . "_struktur." . $ext;
        $folder_tujuan = "../gambar4/struktur/";

        // Buat folder jika belum ada (opsional, tapi disarankan manual)
        // if (!file_exists($folder_tujuan)) mkdir($folder_tujuan, 0777, true);

        move_uploaded_file($tmp_name, $folder_tujuan . $nama_baru);
    }

    $query = "INSERT INTO tabel_struktur (nama, jabatan, foto) VALUES ('$nama', '$jabatan', '$nama_baru')";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        echo "<script>alert('Data berhasil disimpan'); window.location='kelola_struktur.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>YPP Darunnadwah Al-Majidiyah</title>
    <link rel="stylesheet" href="css/kelola_struktur.css">
    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'struktur';
    include 'sidebar.php';
    ?>

    <main class="main-content">
        <header>
            <div class="header-left">
                <i class="fas fa-bars mobile-menu-btn"></i>
                <h2>Tambah Pengurus</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i> <span class="user-name">Admin</span>
            </div>
        </header>

        <div class="content-body">
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: H. Ahmad Fulani, S.Pd" required>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Ketua Yayasan" required>
                    </div>

                    <div class="form-group">
                        <label>Foto Profil (Opsional)</label>
                        <input type="file" name="foto" class="form-control" accept=".jpg, .jpeg, .png">
                        <small style="color: #888; display: block; margin-top: 5px;">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>

                    <div style="margin-top: 30px;">
                        <button type="submit" name="simpan" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="kelola_struktur.php" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        if (menuBtn) menuBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>