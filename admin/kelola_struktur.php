<?php
session_start();
include 'koneksi.php'; // Pastikan path koneksi benar

// Cek apakah admin sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// --- LOGIKA HAPUS DATA STRUKTUR ---
if (isset($_GET['hapus'])) {
    $id_struktur = $_GET['hapus'];

    // 1. Hapus file foto pengurus dulu jika ada
    $q_foto = mysqli_query($conn, "SELECT foto FROM tabel_struktur WHERE id = '$id_struktur'");

    if ($q_foto && mysqli_num_rows($q_foto) > 0) {
        $f = mysqli_fetch_assoc($q_foto);
        $path_foto = "../gambar4/struktur/" . $f['foto'];

        if ($f['foto'] != "" && file_exists($path_foto)) {
            unlink($path_foto);
        }
    }

    // 2. Hapus data dari database
    $query_hapus = "DELETE FROM tabel_struktur WHERE id = '$id_struktur'";

    if (mysqli_query($conn, $query_hapus)) {
        echo "<script>alert('Data pengurus berhasil dihapus'); window.location='kelola_struktur.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
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
    <link rel="stylesheet" href="css/kelola_struktur.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <h3>Daftar Pengurus</h3>
                    <p>Kelola data struktur organisasi yayasan/sekolah</p>
                </div>
            </div>

            <div class="toolbar">
                <form method="GET" action="" class="search-form">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="cari" placeholder="Cari Nama / Jabatan..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>
                </form>

                <a href="tambah_struktur.php" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Pengurus
                </a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Foto</th>
                            <th width="30%">Nama Lengkap</th>
                            <th width="30%">Jabatan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Logika Pencarian
                        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';

                        $query_str = "SELECT * FROM tabel_struktur WHERE nama LIKE '%$keyword%' OR jabatan LIKE '%$keyword%' ORDER BY id DESC";
                        $query = mysqli_query($conn, $query_str);

                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php if ($row['foto'] != ""): ?>
                                            <img src="../gambar4/struktur/<?= $row['foto']; ?>" class="img-thumbnail" alt="Foto">
                                        <?php else: ?>
                                            <div class="no-img"><i class="fas fa-user"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= $row['nama']; ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge-jabatan"><?= $row['jabatan']; ?></span>
                                    </td>
                                    <td>
                                        <div class="action-container">
                                            <a href="edit_struktur.php?id=<?= $row['id']; ?>" class="btn-action btn-edit" title="Edit Data">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <a href="kelola_struktur.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus pengurus ini?')" class="btn-action btn-hapus" title="Hapus Data">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center; padding: 30px; color: #777;'>Data tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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