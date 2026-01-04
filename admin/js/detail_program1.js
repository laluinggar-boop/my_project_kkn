document.addEventListener("DOMContentLoaded", () => {
    // Animasi muncul (reveal)
    const elements = document.querySelectorAll(".reveal-element");
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add("visible");
        }, 100 * index);
    });

    // Transisi halaman halus (Fade out)
    document.querySelectorAll("a").forEach(anchor => {
        anchor.addEventListener("click", function(e) {
            const href = this.getAttribute("href");
            // Cek link valid, bukan hash, dan bukan link eksternal
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

// Toggle Menu Mobile
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
}