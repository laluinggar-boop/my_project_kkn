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
    $id_pesan = $_GET['hapus'];

    // Hapus data dari database (Tabel Kontak)
    $query_hapus = "DELETE FROM tabel_kontak WHERE id = '$id_pesan'";
    $exec_hapus = mysqli_query($conn, $query_hapus);

    if ($exec_hapus) {
        echo "<script>alert('Pesan berhasil dihapus'); window.location='data_pesan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pesan');</script>";
    }
}

// --- LOGIKA EXPORT KE CSV ---
if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data_pesan_masuk.csv');
    $output = fopen('php://output', 'w');

    // Header CSV
    fputcsv($output, array('No', 'Nama Pengirim', 'Email', 'Isi Pesan', 'Tanggal Masuk'));

    $keyword_export = isset($_GET['cari']) ? $_GET['cari'] : '';
    $query_export = "SELECT * FROM tabel_kontak WHERE nama LIKE '%$keyword_export%' OR pesan LIKE '%$keyword_export%' ORDER BY id DESC";
    $result_export = mysqli_query($conn, $query_export);

    $no = 1;
    while ($row = mysqli_fetch_assoc($result_export)) {
        fputcsv($output, array(
            $no++,
            $row['nama'],
            $row['email'],
            $row['pesan'],
            $row['tanggal']
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
    <link rel="stylesheet" href="css/data_pesan.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'pesan';
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
                    <h3>Kotak Masuk</h3>
                    <p>Pesan, pertanyaan, atau saran dari pengunjung website</p>
                </div>
            </div>

            <div class="toolbar">
                <form method="GET" action="" class="search-form">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="cari" placeholder="Cari Pengirim / Isi Pesan..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
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
                            <th width="5%">No</th>
                            <th width="20%">Nama Pengirim</th>
                            <th width="20%">Email</th>
                            <th width="35%">Isi Pesan</th>
                            <th width="15%">Waktu</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';

                        $query = "SELECT * FROM tabel_kontak WHERE nama LIKE '%$keyword%' OR pesan LIKE '%$keyword%' ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><strong><?= htmlspecialchars($row['nama']); ?></strong></td>
                                    <td>
                                        <a href="mailto:<?= htmlspecialchars($row['email']); ?>" class="email-link">
                                            <i class="far fa-envelope"></i> <?= htmlspecialchars($row['email']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= nl2br(htmlspecialchars($row['pesan'])); ?>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y H:i', strtotime($row['tanggal'])); ?> WIB
                                    </td>
                                    <td>
                                        <a href="data_pesan.php?hapus=<?= $row['id']; ?>"
                                            class="btn-hapus"
                                            onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center; padding: 30px; color: #777;'>Belum ada pesan masuk.</td></tr>";
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