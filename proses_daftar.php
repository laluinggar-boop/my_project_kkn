<?php
// --- 1. KONEKSI DATABASE ---
// Sesuaikan path ini dengan lokasi file koneksi Anda
include 'admin/koneksi.php';

// --- 2. CEK TOMBOL DAFTAR ---
if (isset($_POST['daftar'])) {

    // --- 3. TANGKAP DATA DARI FORMULIR ---
    $jenjang      = $_POST['jenjang'];       // PENTING: Menangkap data TK atau SD
    $nama         = $_POST['nama_lengkap'];
    $nisn         = $_POST['nisn'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $jk           = $_POST['jk'];
    $nama_ayah    = $_POST['nama_ayah'];
    $nama_ibu     = $_POST['nama_ibu'];
    $no_wa        = $_POST['no_wa'];
    $alamat       = $_POST['alamat'];

    // --- 4. PROSES UPLOAD FOTO KK ---
    $allowed = array('png', 'jpg', 'jpeg');
    $filename = $_FILES['foto_kk']['name'];
    $ukuran = $_FILES['foto_kk']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    // Cek apakah user benar-benar mengupload file
    if ($filename != "") {
        // Cek Ekstensi
        if (!in_array($ext, $allowed)) {
            echo "<script>alert('Format foto tidak valid! Harus png, jpg, atau jpeg'); window.history.back();</script>";
            exit();
        } else {

            // --- BAGIAN INI YANG DIUBAH (NAMA FILE SESUAI NAMA PENDAFTAR) ---

            // 1. Bersihkan nama (ganti spasi dengan _ dan hapus simbol aneh)
            // Contoh: "Muhammad Ali" menjadi "muhammad_ali"
            $nama_bersih = strtolower(str_replace(' ', '_', $nama));
            $nama_bersih = preg_replace('/[^a-z0-9_]/', '', $nama_bersih);

            // 2. Buat nama file baru
            // Format: nama_bersih_KK_angkaacak.jpg
            // Angka acak (rand) tetap dibutuhkan agar jika ada nama sama, file tidak tertimpa
            $xx = $nama_bersih . '_KK_' . rand(100, 999) . '.' . $ext;

            // ------------------------------------------------------------------

            // Pindahkan file (Pastikan folder 'gambar/kk/' sudah dibuat)
            move_uploaded_file($_FILES['foto_kk']['tmp_name'], 'gambar/kk/' . $xx);

            // --- 5. MASUKKAN KE DATABASE ---
            $query = "INSERT INTO pendaftaran (
                        jenjang, 
                        nama_lengkap, 
                        nisn, 
                        tempat_lahir, 
                        tgl_lahir, 
                        jk, 
                        nama_ayah, 
                        nama_ibu, 
                        no_wa, 
                        alamat, 
                        foto_kk
                      ) VALUES (
                        '$jenjang', 
                        '$nama', 
                        '$nisn', 
                        '$tempat_lahir', 
                        '$tgl_lahir', 
                        '$jk', 
                        '$nama_ayah', 
                        '$nama_ibu', 
                        '$no_wa', 
                        '$alamat', 
                        '$xx'
                      )";

            // Eksekusi Query
            if (mysqli_query($conn, $query)) {
                // Jika Berhasil, alihkan ke halaman sukses atau index
                echo "<script>
                        alert('Pendaftaran Berhasil! Data Anda telah tersimpan.');
                        window.location = 'daftar.php';
                      </script>";
            } else {
                // Jika Gagal Database
                echo "Gagal menyimpan data: " . mysqli_error($conn);
            }
        }
    } else {
        echo "<script>alert('Harap upload Foto KK!'); window.history.back();</script>";
    }
} else {
    // Jika file diakses langsung tanpa klik tombol daftar
    header("Location: index.php");
}
