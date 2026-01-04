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
        anchor.addEventListener("click", function (e) {
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

    // 3. KALKULATOR DONASI (Jika ada di halaman Donasi)
    const donationInput = document.getElementById('donationInput');
    if (donationInput) {
        const resultText = document.getElementById('resultText');
        const buttons = document.querySelectorAll('.amt-btn');
        const COST_PER_MEAL = 50000;

        window.calculateImpact = function (amount) {
            let count = Math.floor(amount / COST_PER_MEAL);
            if (count < 1) {
                resultText.innerHTML = "Nominal donasi belum mencukupi untuk simulasi paket makan siang.";
            } else {
                resultText.innerHTML = `Perkiraan: donasi ini dapat membantu makan siang sekitar <strong>${count} anak</strong>.`;
            }
        };

        window.updateAmount = function (amount, btnElement) {
            donationInput.value = amount;
            calculateImpact(amount);
            buttons.forEach(btn => btn.classList.remove('active'));
            if (btnElement) btnElement.classList.add('active');
        };

        donationInput.addEventListener('input', (e) => {
            const val = parseInt(e.target.value) || 0;
            calculateImpact(val);
            buttons.forEach(btn => btn.classList.remove('active'));
        });
    }
});

// 4. MENU MOBILE
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
}

// 5. HANDLE REGISTER (Khusus Halaman Pendaftaran)
function handleRegister(e) {
    e.preventDefault();
    // Di sini Anda bisa menambahkan logika kirim data ke server/email
    alert("Terima kasih! Data pendaftaran Anda telah berhasil dikirim.");
    e.target.reset(); // Reset form setelah kirim
}

function switchForm(jenjang) {
    // Ambil elemen
    const formTK = document.getElementById('form-tk');
    const formSD = document.getElementById('form-sd');
    const btnTK = document.getElementById('btn-tk');
    const btnSD = document.getElementById('btn-sd');

    if (jenjang === 'tk') {
        // Tampilkan TK, Sembunyikan SD
        formTK.classList.add('active');
        formSD.classList.remove('active');

        // Ubah Style Tombol
        btnTK.classList.add('active');
        btnSD.classList.remove('active');
    } else {
        // Tampilkan SD, Sembunyikan TK
        formSD.classList.add('active');
        formTK.classList.remove('active');

        // Ubah Style Tombol
        btnSD.classList.add('active');
        btnTK.classList.remove('active');
    }
}