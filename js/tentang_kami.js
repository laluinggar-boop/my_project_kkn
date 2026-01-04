document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll('.reveal-element');
    reveals.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('visible'); 
        }, index * 100); 
    });
});

function toggleMenu() { 
    document.getElementById('mobileMenu').classList.toggle('active'); 
}