<?php
// Tentukan halaman aktif berdasarkan variabel $page yang dikirim dari file utama
$active_dashboard = ($page == 'dashboard') ? 'active' : '';
$active_pendaftar = ($page == 'pendaftar') ? 'active' : '';
$active_donasi = ($page == 'donasi') ? 'active' : '';
$active_struktur = ($page == 'struktur') ? 'active' : '';
$active_program = ($page == 'program') ? 'active' : '';
$active_galeri = ($page == 'galeri') ? 'active' : '';
$active_pesan = ($page == 'pesan') ? 'active' : '';
?>

<div class="sidebar">
    <div class="sidebar-header">
        <img src="../image/Logo_YPP_Dawama.png" alt="Logo">
        <span>YPP Darunnadwah Al-Majidiyah</span><br>
    </div>

    <ul class="nav-links">
        <li>
            <a href="dashboard.php" class="<?= $active_dashboard ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="data_pendaftar.php" class="<?= $active_pendaftar ?>">
                <i class="fas fa-user-friends"></i> Data Pendaftar
            </a>
        </li>
        <li>
            <a href="data_donasi.php" class="<?= $active_donasi ?>">
                <i class="fas fa-envelope-open-text"></i> Data Donasi 
            </a>
        </li>
        <li>
            <a href="kelola_struktur.php" class="<?= $active_struktur ?>">
                <i class="fas fa-address-card"></i> Kelola Struktur
            </a>
        </li>
        <li>
            <a href="kelola_program.php" class="<?= $active_program ?>">
                <i class="fas fa-newspaper"></i> Kelola Program
            </a>
        </li>
        <li>
            <a href="kelola_galeri.php" class="<?= $active_galeri ?>">
                <i class="fas fa-image"></i> Kelola Galeri
            </a>
        </li>
        <li>
            <a href="data_pesan.php" class="<?= $active_pesan ?>">
                <i class="fas fa-comments"></i> Pesan Masyarakat
            </a>
        </li>
    </ul>

    <a href="logout.php" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>