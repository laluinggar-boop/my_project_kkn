<?php
session_start();
include 'koneksi.php'; // Pastikan path koneksi benar

// Cek apakah admin sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// --- LOGIKA HAPUS DATA ---
if (isset($_GET['hapus'])) {
    $id_pendaftar = $_GET['hapus'];

    // Hapus file foto dulu jika ada
    $q_foto = mysqli_query($conn, "SELECT foto_kk FROM pendaftaran WHERE id = '$id_pendaftar'");
    if ($q_foto && mysqli_num_rows($q_foto) > 0) {
        $f = mysqli_fetch_assoc($q_foto);
        if ($f['foto_kk'] != "" && file_exists("../gambar/kk/" . $f['foto_kk'])) {
            unlink("../gambar/kk/" . $f['foto_kk']);
        }
    }

    // Hapus data dari database
    $query_hapus = "DELETE FROM pendaftaran WHERE id = '$id_pendaftar'";
    mysqli_query($conn, $query_hapus);
    echo "<script>alert('Data pendaftar berhasil dihapus'); window.location='data_pendaftar.php';</script>";
}

// --- LOGIKA EXPORT KE CSV ---
if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data_pendaftar.csv');
    $output = fopen('php://output', 'w');

    // Header CSV
    fputcsv($output, array('No', 'Jenjang', 'Nama Lengkap', 'NISN', 'Tempat Lahir', 'Tgl Lahir', 'JK', 'Nama Ayah', 'Nama Ibu', 'No WA', 'Alamat', 'Tgl Daftar'));

    $keyword_export = isset($_GET['cari']) ? $_GET['cari'] : '';
    $filter_jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

    $where = "WHERE (nama_lengkap LIKE '%$keyword_export%' OR nisn LIKE '%$keyword_export%')";
    if ($filter_jenjang != "") {
        $where .= " AND jenjang = '$filter_jenjang'";
    }

    $query_export = "SELECT * FROM pendaftaran $where ORDER BY id DESC";
    $result_export = mysqli_query($conn, $query_export);

    $no = 1;
    while ($row = mysqli_fetch_assoc($result_export)) {
        fputcsv($output, array(
            $no++,
            $row['jenjang'],
            $row['nama_lengkap'],
            $row['nisn'],
            $row['tempat_lahir'],
            $row['tgl_lahir'],
            $row['jk'],
            $row['nama_ayah'],
            $row['nama_ibu'],
            "'" . $row['no_wa'],
            $row['alamat'],
            $row['tanggal_daftar']
        ));
    }
    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YPP Darunnadwah Al-Majidiyah</title>

    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">
    <link rel="stylesheet" href="css/data_pendaftar.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'pendaftar';
    include 'sidebar.php';
    ?>

    <main class="main-content">

        <header>
            <div class="header-left" style="display:flex; align-items:center; gap:15px;">
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
                    <h3>Daftar Calon Santri</h3>
                    <p>Data pendaftar via website (TK & SD)</p>
                </div>
            </div>

            <div class="toolbar">
                <form method="GET" action="" class="search-form">

                    <select name="jenjang" class="filter-select" onchange="this.form.submit()">
                        <option value="">Semua Jenjang</option>
                        <option value="TK" <?= (isset($_GET['jenjang']) && $_GET['jenjang'] == 'TK') ? 'selected' : '' ?>>TK</option>
                        <option value="SD" <?= (isset($_GET['jenjang']) && $_GET['jenjang'] == 'SD') ? 'selected' : '' ?>>SD</option>
                    </select>

                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="cari" placeholder="Cari Nama / NIK..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>

                    <a href="?export=true<?= isset($_GET['cari']) ? '&cari=' . $_GET['cari'] : '' ?><?= isset($_GET['jenjang']) ? '&jenjang=' . $_GET['jenjang'] : '' ?>" class="btn-export">
                        <i class="fas fa-file-csv"></i> <span class="export-text">Export CSV</span>
                    </a>
                </form>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenjang</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>WhatsApp</th>
                            <th>Alamat</th>
                            <th>Foto KK</th>
                            <th>Tgl Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
                        $filter_jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

                        $where = "WHERE (nama_lengkap LIKE '%$keyword%' OR nisn LIKE '%$keyword%')";

                        if ($filter_jenjang != "") {
                            $where .= " AND jenjang = '$filter_jenjang'";
                        }

                        $query = "SELECT * FROM pendaftaran $where ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php if ($row['jenjang'] == 'TK'): ?>
                                            <span class="badge badge-tk">TK</span>
                                        <?php else: ?>
                                            <span class="badge badge-sd">SD</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= $row['nama_lengkap']; ?></strong><br>
                                        <small style="color: #777;"><?= $row['jk'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></small>
                                    </td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td>
                                        <a href="https://wa.me/<?= $row['no_wa']; ?>" target="_blank" class="wa-link">
                                            <i class="fab fa-whatsapp"></i> <?= $row['no_wa']; ?>
                                        </a>
                                    </td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td>
                                        <?php if ($row['foto_kk'] != ""): ?>
                                            <a href="../gambar/kk/<?= $row['foto_kk']; ?>" target="_blank" class="btn-lihat">
                                                <i class="far fa-image"></i> Lihat
                                            </a>
                                        <?php else: ?>
                                            <span style="color:#bbb">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($row['tanggal_daftar'])); ?></td>
                                    <td>
                                        <a href="data_pendaftar.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn-hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='9' style='text-align:center; padding: 30px; color: #777;'>Belum ada data pendaftar.</td></tr>";
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