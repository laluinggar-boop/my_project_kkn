<?php
// 1. Hubungkan ke Database
include 'koneksi.php';

// 2. Cek apakah ada ID yang dikirim lewat URL
if (isset($_GET['id'])) {

    // Ambil ID dan bersihkan dari karakter berbahaya (Security)
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 3. Jalankan Query Hapus
    // PENTING: Pastikan 'tabel_kontak' adalah nama tabel Anda
    // PENTING: Pastikan 'id' adalah nama kolom Primary Key di database Anda (bisa jadi id_pesan, id_kontak, dll)
    $query = "DELETE FROM tabel_kontak WHERE id = '$id'";
    $exec  = mysqli_query($conn, $query);

    // 4. Cek hasil eksekusi
    if ($exec) {
        // Jika Berhasil
        echo "<script>
                alert('Pesan berhasil dihapus!');
                window.location = 'data_pesan.php';
              </script>";
    } else {
        // Jika Gagal
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($conn) . "');
                window.location = 'data_pesan.php';
              </script>";
    }
} else {
    // Jika file ini dibuka tanpa ID, kembalikan ke halaman data pesan
    header("Location: data_pesan.php");
    exit();
}
