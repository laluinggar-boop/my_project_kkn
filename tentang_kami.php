<?php
// Konfigurasi Halaman
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'tentang_kami';
$customCss = 'css/tentang_kami.css';
$customJs = 'js/tentang_kami.js';

// --- 1. KONEKSI DATABASE ---
// Sesuaikan path ini dengan lokasi file koneksi.php Anda
// Jika file ini ada di folder utama (root), dan koneksi ada di folder utama/admin/
include 'admin/koneksi.php';

// Memanggil Header
include 'header.php';
?>

<div class="container">
    <section class="about-header reveal-element">
        <h1>Tentang YPP Darunnadwah Al-Majidiyah</h1>
        <p>
            YPP Darunnadwah Al-Majidiyah adalah yayasan yang bergerak di bidang pendidikan, dakwah, dan sosial kemanusiaan. Kami berkomitmen untuk menghadirkan program-program yang amanah, profesional, dan berdampak nyata bagi masyarakat.
        </p>
    </section>

    <section class="about-grid reveal-element">
        <div class="info-card">
            <h3 class="card-title">Visi</h3>
            <div class="card-content">
                <p>Menjadi lembaga pendidikan dan sosial Islam yang amanah, profesional, dan berdampak luas bagi ummat.</p>
            </div>
        </div>
        <div class="info-card">
            <h3 class="card-title">Misi</h3>
            <div class="card-content">
                <ul class="mission-list">
                    <li>Menyelenggarakan pendidikan Islam yang berkualitas dan terjangkau.</li>
                    <li>Membina karakter generasi muda agar berakhlak mulia dan berdaya saing.</li>
                    <li>Mengembangkan program sosial yang memberikan manfaat nyata bagi masyarakat.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="grid-history reveal-element">
        <div class="info-card">
            <h3 class="card-title">Sejarah Singkat Yayasan</h3>
            <div class="card-content">
                <p>
                    YPP Darunnadwah Al-Majidiyah lahir dari kepedulian para pendiri terhadap pentingnya pendidikan Islam yang menyeluruh. Berawal dari majelis kecil di lingkungan sekitar, yayasan ini terus berkembang menjadi lembaga yang menaungi berbagai kegiatan pendidikan, sosial, dan dakwah untuk kemaslahatan ummat.
                    <br><br>
                    Seiring berjalannya waktu, kepercayaan masyarakat semakin tumbuh, memungkinkan kami untuk memperluas jangkauan manfaat ke daerah-daerah yang lebih membutuhkan.
                </p>
            </div>
        </div>
        <div class="info-card">
            <h3 class="card-title">Pilar Kegiatan</h3>
            <div class="card-content">
                <div class="pillar-item">
                    <div class="pillar-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="pillar-text">
                        <h4>Pendidikan</h4>
                        <p>Membina generasi Qurani.</p>
                    </div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon"><i class="fas fa-hands-helping"></i></div>
                    <div class="pillar-text">
                        <h4>Sosial</h4>
                        <p>Pemberdayaan masyarakat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="structure-section reveal-element">
        <div class="structure-box">
            <h2 class="section-heading">Struktur Organisasi Inti</h2>

            <div class="struktur-grid">
                <?php
                // Pastikan koneksi database sudah di-include di bagian paling atas file
                // include 'koneksi.php'; 

                $query = mysqli_query($conn, "SELECT * FROM tabel_struktur ORDER BY id ASC");

                // Cek jika data ada
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>

                        <div class="struktur-card">
                            <div class="foto-wrapper">
                                <?php
                                // Tentukan lokasi foto (Jalur Relatif dari file tentang_kami.php)
                                // Pastikan folder penyimpanan Anda adalah 'gambar/struktur/' atau sesuaikan
                                $path_foto = "gambar4/struktur/" . $row['foto'];

                                // Cek apakah data foto di database tidak kosong DAN filenya benar-benar ada di folder
                                if ($row['foto'] != "" && file_exists($path_foto)) {
                                ?>
                                    <img src="<?= $path_foto; ?>" alt="<?= $row['nama']; ?>" class="profile-img">

                                <?php } else { ?>

                                    <div class="default-icon">
                                        <i class="fas fa-user"></i>
                                    </div>

                                <?php } ?>
                            </div>

                            <div class="info-text">
                                <h4><?= $row['nama']; ?></h4>
                                <p><?= $row['jabatan']; ?></p>
                            </div>
                        </div>

                <?php
                    }
                } else {
                    echo "<p>Data struktur belum tersedia.</p>";
                }
                ?>
            </div>

            <p class="structure-note">
                <i class="fas fa-info-circle"></i> &nbsp;Geser ke samping untuk melihat struktur pengurus lainnya. Struktur di atas dapat berubah sewaktu-waktu sesuai keputusan rapat yayasan.
            </p>
        </div>
    </section>

</div>

<?php
// Memanggil Footer
include 'footer.php';
?>