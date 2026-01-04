<?php
session_start();
include 'koneksi.php'; // Pastikan path koneksi benar

// Cek apakah admin sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}

// --- LOGIKA HAPUS DATA DONASI ---
if (isset($_GET['hapus'])) {
    $id_donasi = $_GET['hapus'];

    // Hapus file bukti transfer dulu jika ada
    $q_foto = mysqli_query($conn, "SELECT bukti_transfer FROM donasi WHERE id = '$id_donasi'");
    if ($q_foto && mysqli_num_rows($q_foto) > 0) {
        $f = mysqli_fetch_assoc($q_foto);
        // Asumsi folder penyimpanan gambar bukti adalah 'gambar/bukti'
        if ($f['bukti_transfer'] != "" && file_exists("../gambar2/bukti/" . $f['bukti_transfer'])) {
            unlink("../gambar2/bukti/" . $f['bukti_transfer']);
        }
    }

    // Hapus data dari database
    $query_hapus = "DELETE FROM donasi WHERE id = '$id_donasi'";
    mysqli_query($conn, $query_hapus);
    echo "<script>alert('Data donasi berhasil dihapus'); window.location='data_donasi.php';</script>";
}

// --- LOGIKA EXPORT KE CSV ---
if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data_donasi.csv');
    $output = fopen('php://output', 'w');

    // Header CSV disesuaikan dengan donasi
    fputcsv($output, array('No', 'Nama Donatur', 'Nominal', 'Metode Pembayaran', 'No WA', 'Keterangan', 'Tgl Donasi'));

    $keyword_export = isset($_GET['cari']) ? $_GET['cari'] : '';
    // Query pencarian donasi
    $query_export = "SELECT * FROM donasi WHERE nama_donatur LIKE '%$keyword_export%' ORDER BY id DESC";
    $result_export = mysqli_query($conn, $query_export);

    $no = 1;
    while ($row = mysqli_fetch_assoc($result_export)) {
        fputcsv($output, array(
            $no++,
            $row['nama_donatur'],
            $row['nominal'],
            $row['metode_pembayaran'],
            "'" . $row['no_wa'],
            $row['keterangan'],
            $row['tanggal_donasi']
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
    <title>YPP Darunnadwah< Al-Majidiyah</title>

    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/data_donasi.css">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'donasi';
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
                    <h3>Data Donasi Masuk</h3>
                    <p>Daftar donatur yang telah melakukan konfirmasi pembayaran</p>
                </div>
            </div>

            <div class="toolbar">
                <form method="GET" action="" class="search-form">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="cari" placeholder="Cari Nama Donatur..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>

                    <a href="?export=true<?= isset($_GET['cari']) ? '&cari=' . $_GET['cari'] : '' ?>" class="btn-export">
                        <i class="fas fa-file-csv"></i> Export CSV
                    </a>
                </form>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>No WhatsApp</th>
                            <th>Bukti Transfer</th>
                            <th>Tgl Donasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';

                        // Query disesuaikan dengan tabel 'donasi'
                        $query = "SELECT * FROM donasi WHERE nama_donatur LIKE '%$keyword%' ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <strong><?= $row['nama_donatur']; ?></strong><br>
                                        <small style="color: #777; font-style: italic;"><?= $row['keterangan']; ?></small>
                                    </td>
                                    <td style="font-weight: bold; color: #2e7d32;">
                                        Rp <?= number_format($row['nominal'], 0, ',', '.'); ?>
                                    </td>
                                    <td><?= $row['metode_pembayaran']; ?></td>
                                    <td>
                                        <a href="https://wa.me/<?= $row['no_wa']; ?>" target="_blank" class="wa-link">
                                            <i class="fab fa-whatsapp"></i> <?= $row['no_wa']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($row['bukti_transfer'] != ""): ?>
                                            <a href="../gambar2/bukti/<?= $row['bukti_transfer']; ?>" target="_blank" class="btn-lihat">
                                                <i class="far fa-image"></i> Lihat
                                            </a>
                                        <?php else: ?>
                                            <span style="color:#bbb">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($row['tanggal_donasi'])); ?></td>
                                    <td>
                                        <a href="data_donasi.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data donasi ini?')" class="btn-hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='8' style='text-align:center; padding: 30px; color: #777;'>Belum ada data donasi.</td></tr>";
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