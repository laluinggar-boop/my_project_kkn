<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'YPP Darunnadwah Al-Majidiyah'; ?></title>

    <link rel="icon" href="image/Logo_YPP_Dawama.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <?php if (isset($customCss)): ?>
        <link rel="stylesheet" href="<?php echo $customCss; ?>">
    <?php elseif (isset($useStyleCss) && $useStyleCss === false): ?>
    <?php else: ?>
        <link rel="stylesheet" href="css/style.css">
    <?php endif; ?>

    <?php if (isset($extraCss)) echo $extraCss; ?>

    <?php if (isset($internalStyle)) echo $internalStyle; ?>
</head>

<body>

    <nav class="reveal-element">
        <div class="logo-area">
            <img src="image/Logo_YPP_Dawama.png" alt="Logo" class="logo-img"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div class="logo-dot" style="display: none; width: 35px; height: 35px; background: #86efac; border-radius: 50%;"></div>
            <span>YPP Darunnadwah Al-Majidiyah</span>
        </div>
        <div class="nav-links" id="mobileMenu">
            <?php
            $p = isset($currentPage) ? $currentPage : '';
            function isActive($pageName, $currentPage)
            {
                return $pageName === $currentPage ? 'active' : '';
            }
            function activeStyle($pageName, $currentPage)
            {
                return $pageName === $currentPage ? 'style="color: var(--dark-green);"' : '';
            }
            ?>

            <a href="index.php" class="<?php echo isActive('beranda', $p); ?>" <?php echo activeStyle('beranda', $p); ?>>Beranda</a>
            <a href="tentang_kami.php" class="<?php echo isActive('tentang_kami', $p); ?>" <?php echo activeStyle('tentang_kami', $p); ?>>Tentang Kami</a>
            <a href="program.php" class="<?php echo isActive('program', $p); ?>" <?php echo activeStyle('program', $p); ?>>Program</a>
            <a href="donasi.php" class="<?php echo isActive('donasi', $p); ?>" <?php echo activeStyle('donasi', $p); ?>>Donasi</a>
            <a href="galeri.php" class="<?php echo isActive('galeri', $p); ?>" <?php echo activeStyle('galeri', $p); ?>>Galeri</a>
            <a href="kontak.php" class="<?php echo isActive('kontak', $p); ?>" <?php echo activeStyle('kontak', $p); ?>>Kontak</a>
            <a href="daftar.php" class="mobile-register-link">Daftar Online <i class="fas fa-arrow-right"></i></a>
        </div>
        <a href="daftar.php" class="btn-nav-donasi">Daftar Sekarang</a>
        <div class="mobile-menu-icon" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    </nav>