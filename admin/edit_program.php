<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// Cek ID
if (!isset($_GET['id'])) {
    header("Location: kelola_program.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tabel_program WHERE id='$id'");
$data = mysqli_fetch_array($query);

// Proses Update
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $fokus = mysqli_real_escape_string($conn, $_POST['fokus']);
    $desk_singkat = mysqli_real_escape_string($conn, $_POST['deskripsi_singkat']);
    $desk_lengkap = mysqli_real_escape_string($conn, $_POST['deskripsi_lengkap']);
    $gambar_lama = $_POST['gambar_lama'];

    // Cek Gambar Baru
    if ($_FILES['gambar']['name'] != "") {
        $filename = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_baru = rand(100, 999) . "_program." . $ext;
        $folder = '../gambar3/program/';

        // Hapus lama
        if ($gambar_lama != "" && file_exists($folder . $gambar_lama)) {
            unlink($folder . $gambar_lama);
        }
        move_uploaded_file($tmp_name, $folder . $nama_baru);
        $gambar_update = $nama_baru;
    } else {
        $gambar_update = $gambar_lama;
    }

    $update = "UPDATE tabel_program SET 
                judul_program='$judul', 
                deskripsi_singkat='$desk_singkat', 
                deskripsi_lengkap='$desk_lengkap', 
                fokus_kegiatan='$fokus', 
                gambar='$gambar_update' 
               WHERE id='$id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='kelola_program.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
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
                <h2>Edit Program</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i> Admin
            </div>
        </header>

        <div class="content-body">

            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">

                    <div class="form-group">
                        <label>Judul Program</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data['judul_program']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Fokus Kegiatan</label>
                        <input type="text" name="fokus" class="form-control" value="<?= $data['fokus_kegiatan']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <textarea name="deskripsi_singkat" class="form-control" required><?= $data['deskripsi_singkat']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Lengkap</label>
                        <textarea name="deskripsi_lengkap" class="form-control text-long" required><?= $data['deskripsi_lengkap']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Program</label>
                        <input type="file" name="gambar" class="form-control">

                        <div style="margin-top: 10px;">
                            <small style="display:block; color:#666;">Gambar Saat Ini:</small>
                            <?php if ($data['gambar'] != ""): ?>
                                <img src="../gambar3/program/<?= $data['gambar']; ?>" class="img-preview" alt="Preview">
                            <?php else: ?>
                                <span style="color:red; font-size:0.9rem;">Belum ada gambar</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                    <div class="form-actions">
                        <button type="submit" name="simpan" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Perubahan
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