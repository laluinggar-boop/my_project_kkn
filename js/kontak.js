document.addEventListener("DOMContentLoaded", () => {
    // 1. ANIMASI REVEAL
    const elements = document.querySelectorAll(".reveal-element");
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add("visible");
        }, 100 * index);
    });

    // 2. TRANSISI HALAMAN
    document.querySelectorAll("a").forEach(anchor => {
        anchor.addEventListener("click", function(e) {
            const href = this.getAttribute("href");
            if (href && href !== "#" && href.indexOf("http") === -1) {
                e.preventDefault();
                document.body.classList.add("fade-out");
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            }
        });
    });
    
    // (Kode Kalkulator Donasi ada di sini jika digabung)
});

// 3. MENU MOBILE
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
}