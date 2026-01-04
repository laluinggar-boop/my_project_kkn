<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// --- LOGIKA HAPUS DATA PROGRAM ---
if (isset($_GET['hapus'])) {
    $id_program = $_GET['hapus'];

    $q_gambar = mysqli_query($conn, "SELECT gambar FROM tabel_program WHERE id = '$id_program'");

    if ($q_gambar && mysqli_num_rows($q_gambar) > 0) {
        $f = mysqli_fetch_assoc($q_gambar);
        $path_file = "../gambar3/program/" . $f['gambar'];

        if ($f['gambar'] != "" && file_exists($path_file)) {
            unlink($path_file);
        }
    }

    $query_hapus = "DELETE FROM tabel_program WHERE id = '$id_program'";
    $exec_hapus = mysqli_query($conn, $query_hapus);

    if ($exec_hapus) {
        echo "<script>alert('Program berhasil dihapus'); window.location='kelola_program.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus program');</script>";
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
    <link rel="stylesheet" href="css/kelola_program.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'program'; // Untuk menandai menu aktif di sidebar
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
                    <h3>Daftar Program</h3>
                    <p>Kelola program kerja dan kegiatan yayasan</p>
                </div>
            </div>

            <div class="toolbar">
                <form action="" method="GET" class="search-form">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="cari" placeholder="Cari program..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>
                </form>

                <a href="tambah_program.php" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Program
                </a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Gambar</th>
                            <th width="20%">Judul Program</th>
                            <th width="15%">Fokus</th>
                            <th width="30%">Deskripsi Singkat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
                        $query_str = "SELECT * FROM tabel_program WHERE judul_program LIKE '%$keyword%' OR fokus_kegiatan LIKE '%$keyword%' ORDER BY id DESC";
                        $query = mysqli_query($conn, $query_str);

                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php if ($row['gambar'] != ""): ?>
                                            <img src="../gambar3/program/<?= $row['gambar']; ?>" class="img-thumbnail" alt="Thumb">
                                        <?php else: ?>
                                            <div class="no-img"><i class="fas fa-image"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong><?= $row['judul_program']; ?></strong></td>
                                    <td>
                                        <span class="badge-fokus"><?= $row['fokus_kegiatan']; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $desc = $row['deskripsi_singkat'];
                                        echo (strlen($desc) > 60) ? substr($desc, 0, 60) . "..." : $desc;
                                        ?>
                                    </td>
                                    <td>
                                        <div class="action-container">
                                            <a href="edit_program.php?id=<?= $row['id']; ?>" class="btn-action btn-edit" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="kelola_program.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus program ini?')" class="btn-action btn-hapus" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center; padding: 30px; color: #777;'>Data tidak ditemukan.</td></tr>";
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

        // Tutup sidebar jika overlay diklik
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }
    </script>
</body>

</html>