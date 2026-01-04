<?php
session_start();
include 'koneksi.php';

// Cek admin login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// --- LOGIKA HAPUS DATA GALERI ---
if (isset($_GET['hapus'])) {
    $id_galeri = $_GET['hapus'];

    // 1. Ambil nama file gambar
    $q_gambar = mysqli_query($conn, "SELECT foto FROM tabel_galeri WHERE id = '$id_galeri'");

    if ($q_gambar && mysqli_num_rows($q_gambar) > 0) {
        $f = mysqli_fetch_assoc($q_gambar);
        // Pastikan path folder sesuai dengan tempat upload
        $path_gambar = "../gambar5/galeri/" . $f['foto'];

        if ($f['foto'] != "" && file_exists($path_gambar)) {
            unlink($path_gambar);
        }
    }

    // 2. Hapus data dari database
    $query_hapus = "DELETE FROM tabel_galeri WHERE id = '$id_galeri'";
    $exec = mysqli_query($conn, $query_hapus);

    if ($exec) {
        echo "<script>alert('Foto berhasil dihapus'); window.location='kelola_galeri.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus foto');</script>";
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
    <link rel="stylesheet" href="css/kelola_galeri.css">

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
                <h2>Selamat Datang</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i>
                <span class="user-name">Admin</span>
            </div>
        </header>

        <div class="content-body">

            <div class="page-header">
                <div class="page-title">
                    <h3>Daftar Dokumentasi</h3>
                    <p>Kelola foto kegiatan dan fasilitas yayasan</p>
                </div>
            </div>

            <div class="toolbar">
                <form action="" method="GET" class="search-form">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="cari" placeholder="Cari judul / kategori..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>
                </form>

                <a href="tambah_galeri.php" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Foto
                </a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Foto</th>
                            <th width="35%">Judul Foto</th>
                            <th width="25%">Kategori</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
                        $query_str = "SELECT * FROM tabel_galeri WHERE judul_foto LIKE '%$keyword%' OR kategori LIKE '%$keyword%' ORDER BY id DESC";
                        $query = mysqli_query($conn, $query_str);

                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php if ($row['foto'] != ""): ?>
                                            <img src="../gambar5/galeri/<?= $row['foto']; ?>" class="img-thumbnail" alt="Foto">
                                        <?php else: ?>
                                            <div class="no-img"><i class="fas fa-image"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong><?= $row['judul_foto']; ?></strong></td>
                                    <td>
                                        <span class="category-badge">
                                            <i class="fas fa-tag"></i> <?= $row['kategori']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-container">
                                            <a href="edit_galeri.php?id=<?= $row['id']; ?>" class="btn-action btn-edit" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="kelola_galeri.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus foto ini?')" class="btn-action btn-hapus" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center; padding: 30px; color: #777;'>Tidak ada data foto.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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