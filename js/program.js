document.addEventListener("DOMContentLoaded", () => {
    // Menangani animasi muncul (reveal)
    const elements = document.querySelectorAll(".reveal-element");
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add("visible");
        }, 100 * index);
    });

    // Menangani transisi halaman saat link diklik
    document.querySelectorAll("a").forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");

            // Cek apakah link valid, bukan hash (#), dan bukan link eksternal (http)
            if (href && href !== "#" && href.indexOf("http") === -1) {
                e.preventDefault();
                document.body.classList.add("fade-out");
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            }
        });
    });
});

// Fungsi untuk toggle menu mobile
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
}