<?php
// --- SETUP AWAL ---
include 'admin/koneksi.php';

// Cek ID Program
if (isset($_GET['id'])) {
    $id_program = mysqli_real_escape_string($conn, $_GET['id']);
} else {
    header("location:program.php");
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM tabel_program WHERE id='$id_program'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>alert('Program tidak ditemukan!'); window.location='program.php';</script>";
    exit();
}

// --- KONFIGURASI HALAMAN ---
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'program';

// PENTING: Panggil CSS dan JS agar animasi header jalan
$customCss = 'css/program.css'; 
$customJs = 'js/program.js'; // <-- INI YANG TADI HILANG

include 'header.php';
?>

<style>
    /* --- PERBAIKAN HEADER MACET --- */
    /* Kode ini memaksa header untuk selalu muncul, mengabaikan animasi yang error */
    nav.navbar, nav.reveal-element {
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }

    /* --- STYLE DETAIL PROGRAM --- */
    :root {
        --primary: #22c55e;
        --dark-heading: #064e3b;
        --text-body: #374151;
        --bg-focus: #f0fdf4;
    }

    body {
        background-color: #fff; /* Pastikan latar belakang putih */
    }

    .detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 20px 80px 20px; /* Tambah padding atas agar tidak ketutup header */
    }

    /* Tombol Kembali */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--dark-heading);
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .btn-back:hover {
        color: var(--primary);
    }

    /* Judul */
    .program-title {
        font-family: 'DM Sans', sans-serif;
        color: var(--dark-heading);
        font-size: 2.2rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 25px;
    }

    /* Gambar */
    .program-image-full {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    /* Teks Deskripsi */
    .program-text {
        font-family: 'Poppins', sans-serif;
        color: var(--text-body);
        line-height: 1.8;
        font-size: 1.05rem;
        text-align: justify;
        margin-bottom: 40px;
    }

    /* Kotak Fokus Kegiatan */
    .focus-section {
        background: var(--bg-focus);
        padding: 30px;
        border-radius: 12px;
        border-left: 5px solid var(--primary);
        margin-top: 30px;
    }
    
    .focus-section h3 {
        color: var(--dark-heading);
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .focus-content ul {
        padding-left: 20px;
        margin: 0;
    }

    .focus-content li {
        margin-bottom: 10px;
        color: var(--text-body);
    }

    /* Responsif HP */
    @media (max-width: 600px) {
        .program-title { font-size: 1.8rem; }
        .detail-container { padding-top: 20px; }
    }
</style>

<div class="detail-container">

    <a href="program.php" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <h1 class="program-title"><?= $data['judul_program']; ?></h1>

    <?php
    $img_path = "gambar3/program/" . $data['gambar'];
    if ($data['gambar'] != "" && file_exists($img_path)) {
        echo '<img src="' . $img_path . '" alt="' . $data['judul_program'] . '" class="program-image-full">';
    }
    ?>

    <div class="program-text">
        <?= nl2br($data['deskripsi_lengkap']); ?>
    </div>

    <?php if (!empty($data['fokus_kegiatan'])): ?>
        <div class="focus-section">
            <h3><i class="fas fa-bullseye" style="color: var(--primary);"></i> Fokus Kegiatan</h3>
            <div class="focus-content">
                <ul>
                    <?php
                    $list_fokus = explode("\n", $data['fokus_kegiatan']);
                    foreach ($list_fokus as $poin) {
                        $poin_bersih = trim($poin, " \t\n\r\0\x0B-");
                        if (!empty($poin_bersih)) {
                            echo "<li>" . $poin_bersih . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>