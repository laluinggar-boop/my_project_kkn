<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// Proses Simpan Data
if (isset($_POST['simpan'])) {
    $judul        = mysqli_real_escape_string($conn, $_POST['judul']);
    $fokus        = mysqli_real_escape_string($conn, $_POST['fokus']);
    $desk_singkat = mysqli_real_escape_string($conn, $_POST['deskripsi_singkat']);
    $desk_lengkap = mysqli_real_escape_string($conn, $_POST['deskripsi_lengkap']);

    // Upload Gambar
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $nama_baru = "";

    if ($filename != "") {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_baru = rand(100, 999) . "_program." . $ext;
        $folder_tujuan = "../gambar3/program/";
        move_uploaded_file($tmp_name, $folder_tujuan . $nama_baru);
    }

    $query = "INSERT INTO tabel_program (judul_program, deskripsi_singkat, deskripsi_lengkap, fokus_kegiatan, gambar) 
              VALUES ('$judul', '$desk_singkat', '$desk_lengkap', '$fokus', '$nama_baru')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil disimpan'); window.location='kelola_program.php';</script>";
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
    <link rel="stylesheet" href="css/kelola_program.css">
    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'program';
    include 'sidebar.php';
    ?>

    <main class="main-content">
        <header>
            <div class="header-left">
                <i class="fas fa-bars mobile-menu-btn" onclick="toggleSidebar()"></i>
                <h2>Tambah Program</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i> Admin
            </div>
        </header>

        <div class="content-body">

            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Judul Program</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Santunan Anak Yatim" required>
                    </div>

                    <div class="form-group">
                        <label>Fokus Kegiatan</label>
                        <input type="text" name="fokus" class="form-control" placeholder="Contoh: Sosial, Dakwah, Pendidikan" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat (Tampilan Depan)</label>
                        <textarea name="deskripsi_singkat" class="form-control" placeholder="Ringkasan singkat..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Lengkap</label>
                        <textarea name="deskripsi_lengkap" class="form-control text-long" placeholder="Jelaskan detail kegiatan..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Sampul</label>
                        <input type="file" name="gambar" class="form-control" required>
                        <small style="color:#777; font-size: 0.85rem;">Format: JPG, PNG. Maksimal 2MB.</small>
                    </div>

                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                    <div class="form-actions">
                        <button type="submit" name="simpan" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="kelola_program.php" class="btn-cancel">
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