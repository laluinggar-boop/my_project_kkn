<?php
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'donasi';
$customCss = 'css/donasi.css';
$customJs = 'js/donasi.js';

include 'header.php';
?>

<div class="container">
    <section class="donation-section">
        <div class="donation-header">
            <h1>Donasi & Infaq</h1>
            <p>Salurkan harta terbaik Anda untuk mendukung program pendidikan dan dakwah kami. Setiap rupiah adalah amanah.</p>
        </div>

        <div class="donation-grid">

            <div class="donation-card">
                <h2 class="card-heading">Rekening Tujuan</h2>

                <div class="bank-info-box">
                    <span class="bank-label">BANK SYARIAH INDONESIA (BSI)</span>
                    <h4 class="bank-name">Kode Bank: 451</h4>
                    <div class="rek-number">1234 5678 90</div>
                    <div class="rek-owner">a.n. YPP Darunnadwah Al-Majidiyah</div>
                </div>

                <div class="bank-info-box" style="margin-top: 20px;">
                    <span class="bank-label">BANK BRI</span>
                    <h4 class="bank-name">Kode Bank: 002</h4>
                    <div class="rek-number">0000 0101 2222 535</div>
                    <div class="rek-owner">a.n. Yayasan Darunnadwah</div>
                </div>

                <div class="qris-box">
                    <span class="bank-label">SCAN QRIS (E-WALLET)</span>
                    <p class="qris-desc">Gopay, OVO, Dana, ShopeePay, LinkAja, dll.</p>
                    <div class="qris-img-placeholder" style="background-image: url('gambar/qris.jpg'); background-size: cover;"></div>
                </div>
            </div>

            <div class="donation-card">
                <h2 class="card-heading">Konfirmasi Donasi</h2>
                <p class="calc-desc">Sudah melakukan transfer? Silakan isi formulir di bawah ini agar donasi tercatat.</p>

                <form action="proses_donasi.php" method="POST" enctype="multipart/form-data">

                    <div class="input-group">
                        <label class="input-label">Nama Donatur (Hamba Allah)</label>
                        <input type="text" name="nama_donatur" class="calc-input" placeholder="Nama Lengkap" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Nomor WhatsApp</label>
                        <input type="number" name="no_wa" class="calc-input" placeholder="08xxxxxxxx" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Nominal Donasi (Rp)</label>
                        <input type="number" name="nominal" class="calc-input" placeholder="Contoh: 100000" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="calc-input" style="background: white;" required>
                            <option value="">- Pilih Metode -</option>
                            <option value="Transfer BSI">Transfer BSI</option>
                            <option value="Transfer BRI">Transfer BRI</option>
                            <option value="QRIS / E-Wallet">QRIS / E-Wallet</option>
                            <option value="Tunai">Tunai (Datang Langsung)</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Bukti Transfer (Foto/Screenshot)</label>
                        <input type="file" name="bukti_transfer" class="calc-input" accept=".jpg, .jpeg, .png" style="padding-top: 10px;" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Doa / Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="calc-input" rows="3" placeholder="Tuliskan doa atau peruntukan donasi..."></textarea>
                    </div>

                    <div class="amount-buttons">
                        <button type="submit" name="kirim_donasi" class="amt-btn active" style="width: 100%; justify-content: center;">Kirim Konfirmasi <i class="fas fa-paper-plane"></i></button>
                    </div>

                </form>
            </div>

        </div>
    </section>
</div>

<?php include 'footer.php'; ?>