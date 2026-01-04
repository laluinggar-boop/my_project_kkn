<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YPP Darunnadwah Al-Majidiyah</title>

    <link rel="icon" href="../image/Logo_YPP_Dawama.png" type="image/png">
    <link rel="stylesheet" href="css/dashboard.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="sidebar-overlay"></div>

    <?php
    $page = 'dashboard';
    include 'sidebar.php';
    ?>

    <main class="main-content">

        <header>
            <div class="header-left">
                <i class="fas fa-bars mobile-menu-btn"></i>
                <h2>Selamat Datang</h2>
            </div>
            <div class="user-profile">
                <i class="far fa-user-circle"></i>
                <span class="user-name">Admin</span>
            </div>
        </header>

        <div class="stats-grid">
            <div class="stat-card green">
                <div class="stat-header">Total Santri <i class="fas fa-users"></i></div>
                <div class="stat-value">1,250 Siswa</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-header">Guru/Ustadz <i class="fas fa-chalkboard-teacher"></i></div>
                <div class="stat-value">85 Orang</div>
            </div>
            <div class="stat-card yellow">
                <div class="stat-header">Perizinan Santri <i class="far fa-id-card"></i></div>
                <div class="stat-value">12 Proses</div>
            </div>
            <div class="stat-card blue">
                <div class="stat-header">Total Alumni <i class="fas fa-user-graduate"></i></div>
                <div class="stat-value">3,500</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card red">
                <div class="stat-header">Tunggakan SPP <i class="fas fa-file-invoice-dollar"></i></div>
                <div class="stat-value">45 Siswa</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">Jumlah Asrama <i class="fas fa-building"></i></div>
                <div class="stat-value">8 Gedung</div>
            </div>
        </div>

        <div class="chart-section">
            <div class="chart-title">Statistik Jumlah Santri Per Kelas (Tahun Ajaran 2025)</div>
            <div class="chart-container">
                <div class="bar-wrapper">
                    <div class="bar" style="height: 60%;"></div>
                    <div class="bar-label">Kelas 7A</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 65%;"></div>
                    <div class="bar-label">Kelas 7B</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 55%;"></div>
                    <div class="bar-label">Kelas 7C</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 75%;"></div>
                    <div class="bar-label">Kelas 8A</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 70%;"></div>
                    <div class="bar-label">Kelas 8B</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 65%;"></div>
                    <div class="bar-label">Kelas 8C</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 80%;"></div>
                    <div class="bar-label">Kelas 9A</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 85%;"></div>
                    <div class="bar-label">Kelas 9B</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 75%;"></div>
                    <div class="bar-label">Kelas 10 MA</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 80%;"></div>
                    <div class="bar-label">Kelas 11 MA</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 90%;"></div>
                    <div class="bar-label">Kelas 12 MA</div>
                </div>
                <div class="bar-wrapper">
                    <div class="bar" style="height: 40%;"></div>
                    <div class="bar-label">Tahfidz</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Event Listeners
        if (menuBtn) {
            menuBtn.addEventListener('click', toggleSidebar);
        }

        // Tutup sidebar jika overlay diklik
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }
    </script>

</body>

</html>