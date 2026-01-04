<?php
// Konfigurasi Halaman
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'program'; 
$customCss = 'css/program.css'; 
$customJs = 'js/program.js';

// --- 1. HUBUNGKAN KE DATABASE ---
// Sesuaikan jalur ini dengan lokasi file koneksi.php Anda
// Jika file program.php ada di folder utama, dan koneksi ada di folder admin:
include 'admin/koneksi.php'; 
// Atau coba: include 'admin/koneksi.php'; jika error.

include 'header.php';
?>

<div class="container">
    <section class="program-section">
        <div class="program-header reveal-element">
            <h1>Program Utama Yayasan</h1>
            <p>Berikut adalah beberapa program utama yang saat ini dijalankan oleh YPP Darunnadwah Al-Majidiyah.</p>
        </div>
        
        <div class="program-grid">
            
            <?php
            // --- 2. AMBIL DATA DARI DATABASE ---
            // Mengambil semua data dari tabel 'program', urutkan dari yang terbaru (id DESC)
            $query = "SELECT * FROM tabel_program ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            // Cek apakah ada data program?
            if (mysqli_num_rows($result) > 0) {
                // --- 3. LOOPING (PERULANGAN) ---
                // Kode di dalam while akan diulang sebanyak jumlah data program
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            
                    <div class="program-card reveal-element">
                        <div class="card-top">
                            <h3><?= $row['judul_program']; ?></h3>
                            
                            <p>
                                <?php 
                                // Potong deskripsi agar tidak kepanjangan di kartu (maksimal 100 karakter)
                                $deskripsi_pendek = substr(strip_tags($row['deskripsi_singkat']), 0, 100);
                                echo $deskripsi_pendek . "...";
                                ?>
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <span class="fokus-label">Fokus: <?= isset($row['fokus']) ? $row['fokus'] : 'Umum'; ?></span>
                            
                            <a href="detail_program.php?id=<?= $row['id']; ?>" class="detail-link">
                                Lihat detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

            <?php 
                } // Akhir dari While
            } else {
                // Jika tidak ada data di database
                echo "<p style='text-align:center; width:100%;'>Belum ada program yang diposting.</p>";
            }
            ?>

        </div>
    </section>
</div>

<?php 
include 'footer.php'; 
?>