<?php
// --- PENGATURAN KONEKSI ---
// Sesuaikan path 'koneksi.php'. 
// Jika file galeri.php ada di folder utama (luar folder admin), 
// biasanya path-nya adalah 'admin/koneksi.php' atau sekedar 'koneksi.php' tergantung lokasi file.
include 'admin/koneksi.php';

// Konfigurasi Halaman
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'galeri';
$customCss = 'css/galeri.css';
$customJs = 'js/galeri.js';

include 'header.php';
?>

<div class="container">
    <section class="gampak-header reveal-element">
        <h1>Galeri & Dampak</h1>
        <p>Jejak kebaikan yang telah kita ukir bersama. Berikut adalah data penerima manfaat dan dokumentasi kegiatan yayasan.</p>
    </section>

    <div class="impact-grid">
        <div class="impact-card">
            <div class="impact-icon icon-green">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="impact-text">
                <h4>Anak Asuh & Santri</h4>
                <div class="number">152</div>
                <p>Anak yatim & penghafal Qur'an dibina.</p>
            </div>
        </div>

        <div class="impact-card">
            <div class="impact-icon icon-lime">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="impact-text">
                <h4>Penerima Sembako</h4>
                <div class="number">340+</div>
                <p>Paket beras & kebutuhan pokok tersalurkan.</p>
            </div>
        </div>

        <div class="impact-card">
            <div class="impact-icon icon-teal">
                <i class="fas fa-users"></i>
            </div>
            <div class="impact-text">
                <h4>Warga Terbantu</h4>
                <div class="number">850+</div>
                <p>Penerima manfaat sosial & layanan umat.</p>
            </div>
        </div>
    </div>
    <section class="gallery-box">
        <h2 style="text-align:center; color:var(--dark-green); font-size:1.8rem; margin-bottom:30px;">Galeri Kegiatan</h2>

        <div class="gallery-grid">

            <?php
            // 1. Query mengambil data dari tabel_galeri
            $query = mysqli_query($conn, "SELECT * FROM tabel_galeri ORDER BY id DESC");

            // 2. Cek apakah ada data?
            if (mysqli_num_rows($query) > 0) {

                // 3. Looping data
                while ($row = mysqli_fetch_array($query)) {
            ?>

                    <div class="gallery-item">
                        <img src="gambar5/galeri/<?php echo $row['foto']; ?>" alt="<?php echo $row['judul_foto']; ?>" class="gallery-img-real">

                        <div class="gallery-caption">
                            <h5><?php echo $row['judul_foto']; ?></h5>

                            <span class="badge-category">
                                <i class="fas fa-tag"></i> <?php echo $row['kategori']; ?>
                            </span>
                        </div>
                    </div>

            <?php
                } // Akhir While
            } else {
                // Jika data kosong
                echo '<p style="text-align:center; width:100%; col-span:3;">Belum ada foto galeri yang diunggah.</p>';
            }
            ?>

        </div>
    </section>
</div>

<?php
include 'footer.php';
?>