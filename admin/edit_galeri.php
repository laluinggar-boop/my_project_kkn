<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: kelola_galeri.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tabel_galeri WHERE id='$id'");
$data = mysqli_fetch_array($query);

// Proses Update
if (isset($_POST['simpan'])) {
    $judul_foto = mysqli_real_escape_string($conn, $_POST['judul_foto']);
    $kategori   = mysqli_real_escape_string($conn, $_POST['kategori']);
    $foto_lama  = $_POST['foto_lama'];
    $foto_update = $foto_lama;

    // Cek upload foto baru
    if ($_FILES['foto']['name'] != "") {
        $filename = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_baru = rand(1000, 9999) . "_galeri." . $ext;
        $folder = '../gambar5/galeri/';

        if (file_exists($folder . $foto_lama) && $foto_lama != "") {
            unlink($folder . $foto_lama);
        }

        if (move_uploaded_file($tmp_name, $folder . $nama_baru)) {
            $foto_update = $nama_baru;
        }
    }

    $update = "UPDATE tabel_galeri SET judul_foto='$judul_foto', kategori='$kategori', foto='$foto_update' WHERE id='$id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='kelola_galeri.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Galeri - Admin</title>
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
                <h2>Edit Galeri</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i> Admin
            </div>
        </header>

        <div class="content-body">
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                    <div class="form-group">
                        <label>Judul Foto</label>
                        <input type="text" name="judul_foto" class="form-control" value="<?= $data['judul_foto']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?= $data['kategori']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control" accept=".jpg, .jpeg, .png">

                        <div style="margin-top: 10px;">
                            <small class="d-block text-muted">Foto Saat Ini:</small>
                            <?php
                            $path_img = "../gambar5/galeri/" . $data['foto'];
                            if ($data['foto'] != "" && file_exists($path_img)) {
                                echo "<img src='$path_img' class='img-preview'>";
                            } else {
                                echo "<span style='color:red'>Belum ada foto</span>";
                            }
                            ?>
                        </div>
                    </div>

                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                    <div class="form-actions">
                        <button type="submit" name="simpan" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Perubahan
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