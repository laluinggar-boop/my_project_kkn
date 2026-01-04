<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// Proses Simpan
if (isset($_POST['simpan'])) {
    $judul    = mysqli_real_escape_string($conn, $_POST['judul_foto']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);

    $filename   = $_FILES['foto']['name'];
    $tmp_name   = $_FILES['foto']['tmp_name'];
    $ukuran     = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];

    if ($error === 0) {
        $ekstensi_valid = ['jpg', 'jpeg', 'png'];
        $ekstensi_file  = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ekstensi_file, $ekstensi_valid)) {
            if ($ukuran < 2000000) { // 2MB
                $nama_file_baru = rand(1000, 9999) . "_galeri." . $ekstensi_file;

                // Pastikan folder ini ada
                $tujuan = "../gambar5/galeri/" . $nama_file_baru;

                if (move_uploaded_file($tmp_name, $tujuan)) {
                    $query = "INSERT INTO tabel_galeri (judul_foto, kategori, foto) VALUES ('$judul', '$kategori', '$nama_file_baru')";

                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('Foto berhasil ditambahkan!'); window.location='kelola_galeri.php';</script>";
                    } else {
                        echo "<script>alert('Gagal database!');</script>";
                    }
                } else {
                    echo "<script>alert('Gagal upload file!');</script>";
                }
            } else {
                echo "<script>alert('Ukuran foto terlalu besar (Max 2MB)!');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak valid!');</script>";
        }
    } else {
        echo "<script>alert('Pilih foto terlebih dahulu!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>YPP Darunnadwah Al-Majidiyah</title>
    <link rel="stylesheet" href="css/kelola_galeri.css">
    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'galeri';
    include 'sidebar.php';
    ?>

    <main class="main-content">
        <header>
            <div class="header-left">
                <i class="fas fa-bars mobile-menu-btn" onclick="toggleSidebar()"></i>
                <h2>Tambah Galeri</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i> Admin
            </div>
        </header>

        <div class="content-body">

            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Judul Foto</label>
                        <input type="text" name="judul_foto" class="form-control" placeholder="Contoh: Kegiatan Santunan 2024" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" placeholder="Contoh: Sosial, Pendidikan, Fasilitas" required>
                    </div>

                    <div class="form-group">
                        <label>Upload Foto</label>
                        <input type="file" name="foto" class="form-control" accept=".jpg, .jpeg, .png" required>
                        <small style="color:#777; font-size: 0.85rem; margin-top: 5px; display:block;">Format: JPG, PNG. Maksimal 2MB.</small>
                    </div>

                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                    <div class="form-actions">
                        <button type="submit" name="simpan" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="kelola_galeri.php" class="btn-cancel">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        if (overlay) overlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>