document.addEventListener('DOMContentLoaded', function () {
    // 1. Ambil elemen
    const menuIcon = document.querySelector('.mobile-menu-icon');
    const navLinks = document.querySelector('.nav-links');

    // 2. Cek apakah elemen ditemukan
    if (menuIcon && navLinks) {
        console.log("Menu Icon Ditemukan, Event Listener Dipasang."); // Cek di Console Browser (F12)

        menuIcon.addEventListener('click', function (e) {
            // Mencegah event bubbling (opsional, untuk keamanan)
            e.stopPropagation();

            // Toggle Class
            navLinks.classList.toggle('active');

            // Ubah Ikon
            const icon = menuIcon.querySelector('i');
            if (navLinks.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Tutup menu jika klik di luar area menu
        document.addEventListener('click', function (e) {
            if (!menuIcon.contains(e.target) && !navLinks.contains(e.target)) {
                navLinks.classList.remove('active');
                const icon = menuIcon.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });

    } else {
        console.error("EROR: Class .mobile-menu-icon atau .nav-links tidak ditemukan di HTML header.php!");
    }

    // 3. Animasi Reveal (Kode Lama)
    window.addEventListener('scroll', reveal);
    function reveal() {
        var reveals = document.querySelectorAll('.reveal-element');
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var revealTop = reveals[i].getBoundingClientRect().top;
            var revealPoint = 150;
            if (revealTop < windowHeight - revealPoint) {
                reveals[i].classList.add('visible');
            }
        }
    }
    reveal();
});