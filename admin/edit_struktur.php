<?php
session_start();
include 'koneksi.php';

// Cek status login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// 1. CEK ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID Pengurus tidak ditemukan!'); window.location='kelola_struktur.php';</script>";
    exit();
}

$id = $_GET['id'];

// 2. AMBIL DATA LAMA
$query = mysqli_query($conn, "SELECT * FROM tabel_struktur WHERE id='$id'");
$data = mysqli_fetch_array($query);

// 3. PROSES UPDATE DATA
if (isset($_POST['simpan'])) {
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan     = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $gambar_lama = $_POST['foto_lama']; // Ambil dari input hidden

    // Cek apakah Admin mengupload gambar baru?
    if ($_FILES['gambar']['name'] != "") {
        $nama_file = $_FILES['gambar']['name'];
        $source    = $_FILES['gambar']['tmp_name'];
        $ext       = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = rand(100, 999) . "_struktur." . $ext;
        $folder    = '../gambar4/struktur/';

        // Hapus gambar lama jika ada
        if ($gambar_lama != "" && file_exists($folder . $gambar_lama)) {
            unlink($folder . $gambar_lama);
        }

        // Upload baru
        move_uploaded_file($source, $folder . $nama_baru);

        // Update DB dengan gambar baru
        $sql_update = "UPDATE tabel_struktur SET nama='$nama', jabatan='$jabatan', foto='$nama_baru' WHERE id='$id'";
    } else {
        // Update DB tanpa ganti gambar
        $sql_update = "UPDATE tabel_struktur SET nama='$nama', jabatan='$jabatan' WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='kelola_struktur.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
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
                <h2>Edit Pengurus</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i> <span class="user-name">Admin</span>
            </div>
        </header>

        <div class="content-body">
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="<?= $data['jabatan']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Ganti Foto (Biarkan kosong jika tidak ingin mengganti)</label>
                        <input type="file" name="gambar" class="form-control" accept=".jpg, .jpeg, .png">

                        <div style="margin-top: 15px; padding: 10px; background: #f9f9f9; border-radius: 8px; display: inline-block;">
                            <span style="display:block; font-size: 0.85rem; margin-bottom:5px; color:#666;">Foto Saat Ini:</span>
                            <?php
                            $path_img = "../gambar4/struktur/" . $data['foto'];
                            if ($data['foto'] != "" && file_exists($path_img)) {
                                echo "<img src='$path_img' style='height: 80px; border-radius: 4px; border: 1px solid #ddd;'>";
                            } else {
                                echo "<span style='color: #999; font-style: italic;'>Tidak ada foto</span>";
                            }
                            ?>
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <button type="submit" name="simpan" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Perubahan
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