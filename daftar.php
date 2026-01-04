<?php
$pageTitle = 'YPP Darunnadwah Al-Majidiyah';
$currentPage = 'daftar';
$customCss = 'css/daftar.css';
$customJs = 'js/daftar.js';

include 'header2.php';
?>

<div class="container">
    <section class="register-section">
        <div class="register-header reveal-element">
            <h1>Formulir Pendaftaran Online</h1>
            <p>Silakan pilih jenjang pendidikan dan isi data diri calon santri dengan lengkap.</p>
        </div>

        <div class="jenjang-selector reveal-element">
            <button class="btn-jenjang active" onclick="switchForm('tk')" id="btn-tk">
                <i class="fas fa-shapes"></i> Daftar TK
            </button>
            <button class="btn-jenjang" onclick="switchForm('sd')" id="btn-sd">
                <i class="fas fa-book-reader"></i> Daftar SD
            </button>
        </div>

        <div id="form-tk" class="form-container active">
            <form class="form-card reveal-element" action="proses_daftar.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="jenjang" value="TK">

                <div style="background: #e0f2f1; padding: 15px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #009688;">
                    <h4 style="margin:0; color:#00695c;"><i class="fas fa-info-circle"></i> Formulir Pendaftaran TK</h4>
                </div>

                <h3 class="form-section-title"><i class="fas fa-child"></i> Data Calon Murid TK</h3>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Lengkap Anak</label>
                        <input type="text" name="nama_lengkap" class="form-input" required placeholder="Sesuai Akta Kelahiran">
                    </div>
                    <div class="form-group">
                        <label>NIK (Dari KK)</label>
                        <input type="number" name="nisn" class="form-input" required placeholder="Nomor Induk Kependudukan">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label><input type="radio" name="jk" value="L" checked> Laki-laki</label>
                            <label><input type="radio" name="jk" value="P"> Perempuan</label>
                        </div>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-users"></i> Data Orang Tua</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>No. WhatsApp</label>
                        <input type="tel" name="no_wa" class="form-input" required placeholder="Contoh: 0812...">
                    </div>
                    <div class="form-group full-width">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-textarea" required></textarea>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-file-upload"></i> Berkas Dokumen</h3>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Upload Foto Kartu Keluarga (KK)</label>
                        <input type="file" name="foto_kk" class="form-input" accept="image/*" required>
                        <small style="color: #64748b; font-size: 0.85em; margin-top:5px; display:block;">
                            *Format: JPG/JPEG/PNG. Pastikan foto terlihat jelas.
                        </small>
                    </div>
                </div>

                <button type="submit" name="daftar" class="btn-submit">
                    Daftar TK Sekarang <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>

        <div id="form-sd" class="form-container">
            <form class="form-card reveal-element" action="proses_daftar.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="jenjang" value="SD">

                <div style="background: #e8f5e9; padding: 15px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #4caf50;">
                    <h4 style="margin:0; color:#2e7d32;"><i class="fas fa-info-circle"></i> Formulir Pendaftaran SD</h4>
                </div>

                <h3 class="form-section-title"><i class="fas fa-user-graduate"></i> Data Calon Siswa SD</h3>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-input" required placeholder="Sesuai Ijazah TK / Akta">
                    </div>
                    <div class="form-group">
                        <label>NIK / NISN</label>
                        <input type="number" name="nisn" class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label><input type="radio" name="jk" value="L" checked> Laki-laki</label>
                            <label><input type="radio" name="jk" value="P"> Perempuan</label>
                        </div>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-users"></i> Data Orang Tua / Wali</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>No. WhatsApp</label>
                        <input type="tel" name="no_wa" class="form-input" required placeholder="Contoh: 0812...">
                    </div>
                    <div class="form-group full-width">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-textarea" required></textarea>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-file-upload"></i> Berkas Dokumen</h3>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Upload Foto Kartu Keluarga (KK)</label>
                        <input type="file" name="foto_kk" class="form-input" accept="image/*" required>
                        <small style="color: #64748b; font-size: 0.85em; margin-top:5px; display:block;">
                            *Format: JPG/JPEG/PNG. Pastikan foto terlihat jelas.
                        </small>
                    </div>
                </div>

                <button type="submit" name="daftar" class="btn-submit">
                    Daftar SD Sekarang <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>

    </section>
</div>

<?php include 'footer.php'; ?>