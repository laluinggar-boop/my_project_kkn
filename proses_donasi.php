<?php
// Hubungkan ke database
// Sesuaikan path 'koneksi.php' jika lokasi file koneksi Anda berbeda
include 'admin/koneksi.php';

if (isset($_POST['kirim_donasi'])) {

    // 1. Ambil Data Form
    $nama    = mysqli_real_escape_string($conn, $_POST['nama_donatur']);
    $wa      = mysqli_real_escape_string($conn, $_POST['no_wa']);
    $nominal = mysqli_real_escape_string($conn, $_POST['nominal']);
    $metode  = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
    $ket     = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // 2. Proses Upload Foto Bukti
    $filename = $_FILES['bukti_transfer']['name'];
    $tmp_name = $_FILES['bukti_transfer']['tmp_name'];
    $ukuran   = $_FILES['bukti_transfer']['size'];
    $ext      = pathinfo($filename, PATHINFO_EXTENSION);

    // Cek ekstensi file
    $ekstensi_valid = ['png', 'jpg', 'jpeg'];

    if (!in_array(strtolower($ext), $ekstensi_valid)) {
        echo "<script>alert('Format file harus JPG atau PNG!'); window.location='donasi.php';</script>";
        exit;
    }

    if ($ukuran > 2000000) { // Maksimal 2MB
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.'); window.location='donasi.php';</script>";
        exit;
    }

    // --- BAGIAN INI YANG DIUBAH (NAMA FILE SESUAI NAMA DONATUR) ---

    // 1. Bersihkan nama donatur (ganti spasi dengan _ dan hapus simbol aneh)
    // Contoh: "Hamba Allah" menjadi "hamba_allah"
    $nama_bersih = strtolower(str_replace(' ', '_', $nama));
    $nama_bersih = preg_replace('/[^a-z0-9_]/', '', $nama_bersih);

    // 2. Buat nama file baru
    // Format: nama_bersih_BUKTI_angkaacak.jpg
    $nama_file_baru = $nama_bersih . '_BUKTI_' . rand(100, 999) . '.' . $ext;

    // ------------------------------------------------------------------

    // Tentukan folder penyimpanan (Pastikan folder 'gambar2/bukti' sudah dibuat)
    $tujuan = 'gambar2/bukti/' . $nama_file_baru;

    if (move_uploaded_file($tmp_name, $tujuan)) {

        // 3. Masukkan ke Database
        // Kolom ID dan Tanggal otomatis terisi (Auto Increment & Current Timestamp)
        $query = "INSERT INTO donasi (nama_donatur, nominal, metode_pembayaran, no_wa, keterangan, bukti_transfer) 
                  VALUES ('$nama', '$nominal', '$metode', '$wa', '$ket', '$nama_file_baru')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Terima kasih! Konfirmasi donasi Anda berhasil dikirim.');
                    window.location = 'donasi.php';
                  </script>";
        } else {
            echo "Error Database: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Gagal mengupload bukti transfer. Coba lagi.'); window.location='donasi.php';</script>";
    }
} else {
    // Jika mencoba akses langsung tanpa submit form
    header("Location: donasi.php");
}
