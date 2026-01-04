<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YPP Darunnadwah Al-Majidiyah</title>

    <link rel="icon" href="image\Logo_YPP_Dawama.png" type="image/png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- CSS STANDAR (SAMA UNTUK SEMUA HALAMAN) --- */
        :root {
            --primary-green: #74e38c;
            --primary-hover: #5cd676;
            --dark-green: #0b3b24;
            --footer-bg: #022c22;
            --text-grey: #64748b;
            --bg-gradient-start: #fffbf2;
            --bg-gradient-mid: #f0fdf4;
            --bg-gradient-end: #dcfce7;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-mid) 40%, var(--bg-gradient-end) 100%);
            color: #1e293b;
            min-height: 100vh;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            display: flex; flex-direction: column;
            padding-top: 130px; /* Standar jarak atas */
        }

        /* --- CONTAINER (DISEJAJARKAN DENGAN NAVBAR) --- */
        .container { 
            max-width: 1100px; /* Disamakan dengan max-width Navbar */
            width: 95%; 
            margin: 0 auto; 
            padding: 0 24px; /* Disamakan dengan padding Navbar */
        }

        /* --- NAVBAR (POSISI TETAP) --- */
        nav {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            width: 95%; max-width: 1100px; z-index: 1000;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6); border-radius: 100px;
            
            /* Padding Konsisten */
            padding: 12px 16px 12px 24px; 
            
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .logo-area { display: flex; align-items: center; gap: 12px; font-weight: 700; color: #1f2937; font-size: 0.95rem; }
        .logo-img { height: 40px; width: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .nav-links { display: flex; gap: 20px; }
        .nav-links a { text-decoration: none; color: #64748b; font-size: 0.9rem; font-weight: 600; transition: color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--dark-green); }
        .btn-nav-donasi { background-color: var(--primary-green); color: #064e3b; padding: 10px 24px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: transform 0.2s; }
        .btn-nav-donasi:hover { transform: translateY(-2px); background-color: var(--primary-hover); }

        /* --- CSS HALAMAN DETAIL --- */
        .detail-section { padding-bottom: 80px; max-width: 800px; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #4ade80; font-weight: 600; font-size: 0.95rem; margin-bottom: 24px; transition: color 0.2s; }
        .back-link:hover { color: #16a34a; }
        
        .detail-title { font-size: 2.5rem; color: var(--dark-green); font-weight: 800; line-height: 1.2; margin-bottom: 24px; letter-spacing: -0.5px; }
        .detail-content p { font-size: 1.1rem; color: #334155; line-height: 1.8; margin-bottom: 40px; }
        
        .focus-section h3 { font-size: 1.5rem; color: #064e3b; font-weight: 700; margin-bottom: 20px; }
        .focus-list { list-style: none; padding: 0; }
        .focus-list li { position: relative; padding-left: 24px; margin-bottom: 12px; font-size: 1.05rem; color: #1e293b; line-height: 1.6; }
        .focus-list li::before { content: "•"; position: absolute; left: 0; color: #1e293b; font-weight: bold; font-size: 1.2rem; line-height: 1.5; }

        /* --- FOOTER MINIMALIS (BARU) --- */
        .footer {
            background-color: var(--footer-bg);
            color: #94a3b8; /* Warna teks abu-abu terang */
            padding: 25px 0; /* Padding kecil */
            margin-top: auto;
            text-align: center;
            font-size: 0.85rem;
        }

        @media (max-width: 900px) {
            nav { flex-direction: column; gap: 15px; border-radius: 24px; margin-top: 15px; width: 90%; }
            .nav-links { display: none; }
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
            .detail-title { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo-area">
            <img src="image\Logo_YPP_Dawama.png" alt="Logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div class="logo-dot" style="display: none;"></div>
            <span>YPP Darunnadwah Al-Majidiyah</span>
        </div>
        <div class="nav-links">
            <a href="index.html">Beranda</a>
            <a href="tentang_kami.html">Tentang Kami</a>
            <a href="program.html" class="active" style="color: var(--dark-green);">Program</a>
            <a href="donasi.html">Donasi</a>
            <a href="galeri.html">Galeri & Dampak</a>
            <a href="kontak.html">Kontak</a>
        </div>
        <a href="donasi.html" class="btn-nav-donasi">Daftar Sekarang</a>
    </nav>

    <div class="container">
        <section class="detail-section">
            <a href="program.html" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Program
            </a>

            <h1 class="detail-title">Program Pendidikan Anak & Santri</h1>
            
            <div class="detail-content">
                <p>
                    Program ini berfokus pada pembinaan karakter dan keilmuan anak-anak dan santri melalui tahsin-tahfidz Al-Qur'an, kajian dasar-dasar Islam, serta dukungan pelajaran umum.
                    <br>
                    Kegiatan dilaksanakan secara rutin setiap pekan dengan pengajar yang amanah dan berpengalaman.
                </p>
            </div>

            <div class="focus-section">
                <h3>Fokus Kegiatan</h3>
                <ul class="focus-list">
                    <li>Kelas tahsin dan tahfidz Al-Qur'an harian</li>
                    <li>Pembinaan akhlak dan adab keseharian</li>
                    <li>Pendampingan belajar pelajaran sekolah</li>
                </ul>
            </div>
        </section>
    </div>

    <footer class="footer">
        <div class="container">
            &copy; 2025 YPP Darunnadwah Al-Majidiyah. All rights reserved.
        </div>
    </footer>

</body>
</html>