// Toggle Menu Mobile
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
}

// Tab Switcher (Testimoni & Berita)
function switchTab(tabName) {
    const btnTesti = document.getElementById('btn-testimoni');
    const btnBerita = document.getElementById('btn-berita');
    const panelTesti = document.getElementById('panel-testimoni');
    const panelBerita = document.getElementById('panel-berita');

    if (tabName === 'testimoni') {
        btnTesti.classList.add('active');
        btnBerita.classList.remove('active');
        panelTesti.classList.remove('hidden');
        panelTesti.classList.add('fade-in');
        panelBerita.classList.add('hidden');
    } else if (tabName === 'berita') {
        btnBerita.classList.add('active');
        btnTesti.classList.remove('active');
        panelBerita.classList.remove('hidden');
        panelBerita.classList.add('fade-in');
        panelTesti.classList.add('hidden');
    }
}

// FAQ Accordion
const faqQuestions = document.querySelectorAll('.faq-question');
faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
        const item = question.parentElement;
        const answer = item.querySelector('.faq-answer');
        item.classList.toggle('active');
        if (item.classList.contains('active')) {
            answer.style.maxHeight = answer.scrollHeight + "px";
        } else {
            answer.style.maxHeight = null;
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    // Menangani animasi muncul (reveal)
    const elements = document.querySelectorAll(".reveal-element");
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add("visible");
        }, 100 * index);
    });
})

// Inisialisasi Library AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        once: false, // Animasi hanya terjadi sekali saat scroll ke bawah
        offset: 50, // Mulai animasi sedikit lebih awal
        duration: 800,
    });
});