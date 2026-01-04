<?php
// Konfigurasi Halaman
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'beranda'; // Menu Beranda akan otomatis aktif/hijau

// File CSS khusus untuk Beranda
$customCss = 'css/index.css';
$customJs = 'js/index.js';

// Tambahan Library AOS (Animation on Scroll)
$extraCss = '<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">';
$extraJs = '<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>';

// Memanggil Header (Navigasi & Head)
include 'header.php';
?>

    <section class="hero">
        <div class="container" style="position: relative; z-index: 2;">

            <div class="badge reveal-element">
                <div class="badge-dot"></div> YAYASAN PENDIDIKAN & SOSIAL ISLAM
            </div>

            <h1 class="reveal-element">Bersama Mewujudkan Generasi<br>Qurani yang Berdaya</h1>

            <p class="subtitle reveal-element">Yayasan pendidikan dan sosial yang berfokus pada pembinaan anak-anak,
                santri, dan masyarakat melalui pendidikan Islam, dakwah, dan pemberdayaan sosial.</p>

            <div class="hero-buttons reveal-element">
                <a href="daftar.php" class="btn-hero-primary">Daftar Sekarang <i class="fas fa-arrow-right"
                        style="margin-left:8px; font-size: 0.8em;"></i></a>
                <a href="donasi.php" class="btn-hero-outline">Donasi</a>
            </div>

            <div class="stats-wrapper">
                <div class="stat-card reveal-element">
                    <div class="icon-box bg-green-light"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-info">
                        <h3>Santri & Penerima Manfaat</h3>
                        <div class="num">528+</div>
                        <p>Telah merasakan manfaat program</p>
                    </div>
                </div>
                <div class="stat-card reveal-element">
                    <div class="icon-box bg-lime-light"><i class="fas fa-hand-holding-heart"></i></div>
                    <div class="stat-info">
                        <h3>Relawan & Penggerak</h3>
                        <div class="num">47+</div>
                        <p>Bersama meluaskan kebaikan</p>
                    </div>
                </div>
                <div class="stat-card reveal-element">
                    <div class="icon-box bg-blue-light"><i class="fas fa-chart-line"></i></div>
                    <div class="stat-info">
                        <h3>Program Aktif</h3>
                        <div class="num">4</div>
                        <p>Pendidikan, dakwah, & sosial</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="one-section">
        <div class="container">
            <div class="grid-2-col">
                <div class="why-us reveal-element" data-aos="zoom-out-right">
                    <h2>Mengapa YPP Darunnadwah Al-Majidiyah?</h2>
                    <p class="desc">Kami berupaya menghadirkan pendidikan Islam yang membumi, program sosial yang tepat
                        sasaran, dan dakwah yang menyejukkan hati.</p>
                    <ul class="custom-list">
                        <li>Menyelenggarakan pendidikan Islam yang berkualitas dan terjangkau.</li>
                        <li>Membina karakter generasi muda agar berakhlak mulia dan berdaya saing.</li>
                        <li>Mengembangkan program sosial yang memberikan manfaat nyata bagi masyarakat.</li>
                    </ul>
                    <a href="tentang_kami.php" class="link-green">Pelajari lebih jauh tentang kami</a>
                </div>
                <div class="vision-card reveal-element" data-aos="zoom-out-left">
                    <span class="vision-label">Visi Yayasan</span>
                    <h3 class="vision-text">Menjadi lembaga pendidikan dan sosial Islam yang amanah, profesional, dan
                        berdampak luas bagi ummat.</h3>
                    <p class="vision-sub">Visi ini menjadi landasan dalam setiap program dan keputusan yang kami ambil
                        bersama para pengurus, relawan, dan donatur.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="two-section">
        <div class="container">
            <div class="testi-header-flex reveal-element">
                <div class="testi-title">
                    <h2>Suara Mereka</h2>
                    <p>Cerita singkat dari para penerima manfaat, relawan, dan donatur.</p>
                </div>
                <div class="toggle-wrapper">
                    <button id="btn-testimoni" class="btn-toggle active"
                        onclick="switchTab('testimoni')">Testimoni</button>
                    <button id="btn-berita" class="btn-toggle" onclick="switchTab('berita')">Berita Terbaru</button>
                </div>
            </div>

            <div id="panel-testimoni" class="masonry-grid fade-in">
                <div class="card-item reveal-element" data-aos="fade-up">
                    <p class="quote">“Alhamdulillah, sejak anak kami ikut program tahfidz di YPP Darunnadwah
                        Al-Majidiyah, perubahan akhlak dan kedisiplinannya sangat terasa.”</p>
                    <div class="person">
                        <h4>Fulan, Orang Tua Santri</h4><span>Orang tua penerima manfaat</span>
                    </div>
                </div>
                <div class="card-item reveal-element" data-aos="fade-up">
                    <p class="quote">“Menjadi relawan di yayasan ini membuat saya banyak belajar tentang keikhlasan
                        dalam membantu sesama.”</p>
                    <div class="person">
                        <h4>Relawan</h4><span>Relawan lapangan</span>
                    </div>
                </div>
                <div class="card-item reveal-element" data-aos="fade-up">
                    <p class="quote">“Saya memilih berdonasi di sini karena laporan penyaluran yang jelas dan kegiatan
                        yang benar-benar menyentuh masyarakat.”</p>
                    <div class="person">
                        <h4>Hamba Allah</h4><span>Donatur</span>
                    </div>
                </div>
            </div>

            <div id="panel-berita" class="masonry-grid hidden fade-in">
                <div class="card-item reveal-element" data-aos="fade-up">
                    <span class="news-tag">KEGIATAN SOSIAL</span>
                    <h3 class="news-title">Penyaluran Santunan Yatim Bulan Muharram</h3><span class="news-date">12
                        Agustus 2025</span>
                    <p class="news-desc">Yayasan menyalurkan santunan kepada 80 anak yatim dan dhuafa di lingkungan
                        sekitar.</p>
                </div>
                <div class="card-item reveal-element" data-aos="fade-up">
                    <span class="news-tag">PENDIDIKAN</span>
                    <h3 class="news-title">Wisuda Tahfidz Santri Angkatan ke-3</h3><span class="news-date">28 Juli
                        2025</span>
                    <p class="news-desc">Sebanyak 25 santri berhasil menyelesaikan hafalan juz 30 dan mendapatkan
                        sertifikat.</p>
                </div>
                <div class="card-item reveal-element" data-aos="fade-up">
                    <span class="news-tag">PEMBERDAYAAN</span>
                    <h3 class="news-title">Pelatihan Keterampilan Usaha Mikro untuk Ibu-Ibu</h3><span
                        class="news-date">5 Juli 2025</span>
                    <p class="news-desc">Program pemberdayaan ekonomi kembali digelar dengan fokus pada usaha makanan
                        rumahan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="three-section">
        <div class="container">
            <div class="faq-section reveal-element">
                <div class="faq-header">
                    <h2>Pertanyaan yang Sering Diajukan</h2>
                    <p>Beberapa hal yang sering ditanyakan oleh calon donatur dan relawan.</p>
                </div>
                <div class="faq-list">
                    <div class="faq-item"><button class="faq-question">Apakah donasi bisa dilakukan secara rutin setiap
                            bulan?<i class="fas fa-chevron-down"></i></button>
                        <div class="faq-answer">
                            <p>Ya, tentu saja. Anda dapat mendaftar sebagai donatur tetap untuk mendukung
                                program-program kami
                                secara berkelanjutan.</p>
                        </div>
                    </div>
                    <div class="faq-item"><button class="faq-question">Apakah ada laporan penyaluran donasi?<i
                                class="fas fa-chevron-down"></i></button>
                        <div class="faq-answer">
                            <p>Kami sangat menjunjung tinggi amanah. Laporan penyaluran donasi akan dikirimkan secara
                                berkala
                                melalui email atau WhatsApp.</p>
                        </div>
                    </div>
                    <div class="faq-item"><button class="faq-question">Bagaimana jika ingin menjadi relawan?<i
                                class="fas fa-chevron-down"></i></button>
                        <div class="faq-answer">
                            <p>Kami sangat terbuka bagi siapa saja yang ingin bergabung dalam kebaikan. Silakan hubungi
                                kami
                                melalui kontak WhatsApp.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
// Memanggil Footer
include 'footer.php'; 
?>