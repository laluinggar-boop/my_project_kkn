<?php
// 1. Hubungkan ke Database
// Pastikan path ini benar. Jika file koneksi ada di dalam folder admin, gunakan 'admin/koneksi.php'
include 'admin/koneksi.php';

// ... kode koneksi ...

if (isset($_POST['kirim'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $query = "INSERT INTO tabel_kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    $exec  = mysqli_query($conn, $query);

    if ($exec) {
        echo "<script>alert('Terima kasih! Pesan Anda telah terkirim.'); window.location='kontak.php';</script>";
    } else {
        // TAMPILKAN ERROR ASLI DARI DATABASE UNTUK DEBUGGING
        echo "Error: " . mysqli_error($conn);
        // Jangan lupa hapus baris echo di atas jika website sudah live
    }
}

// Konfigurasi Halaman
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'kontak'; // Menu "Kontak" akan otomatis aktif
$customCss = 'css/kontak.css'; // Memuat CSS khusus halaman ini
$customJs = 'js/kontak.js';

include 'header.php';
?>

<div class="container">

    <section class="contact-section reveal-element">

        <div class="contact-header">
            <h1>Kontak & Lokasi</h1>
            <p>
                Silakan hubungi kami melalui formulir berikut atau kanal komunikasi resmi yayasan.
            </p>
        </div>

        <div class="contact-grid">

            <div class="card-box left-column-card">
                <h2 class="card-heading">Formulir Kontak</h2>
                <form action="#" method="POST" style="display: flex; flex-direction: column; height: 100%;">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-input" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" placeholder="email@contoh.com" required>
                    </div>
                    <div class="form-group form-group-textarea">
                        <label class="form-label">Pesan</label>
                        <textarea name="pesan" class="form-textarea" placeholder="Tuliskan pesan Anda..." required></textarea>
                    </div>
                    <button type="submit" name="kirim" class="btn-submit">Kirim Pesan <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>

            <div class="right-column">

                <div class="card-box" style="flex-shrink: 0;">
                    <h2 class="card-heading">Informasi Kontak</h2>
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">Dusun Karang Petak, Aikmel Utara,</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Kontak</span>
                            <span class="info-value">+62 812-3456-7890 (WA) <br> info@darunnadwah.org</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Media Sosial</span>
                            <div class="social-links-text">
                                <a href="#"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                                <a href="#"><i class="fab fa-youtube"></i> YouTube</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card-box map-card">
                    <h2 class="card-heading" style="margin-bottom: 10px;">Lokasi</h2>
                    <div class="map-container">
                        <iframe
                            class="map-iframe"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d615.2590906327129!2d116.51373975526991!3d-8.546464486678913!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcc37f6a88cd751%3A0xa5ecdbb3fa91c5d1!2sYPP%20Darunnadwah%20Almajidiyah%20NWDI!5e1!3m2!1sid!2sid!4v1765940526735!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>"
                        width="400" height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>

<?php include 'footer.php'; ?>