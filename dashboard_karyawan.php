<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Karyawan') {
    header("Location: formlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Karyawan</title>
    <link href="dashboard_karyawan.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
            <p>Akses informasi dan kelola profil Anda</p>
        </div>
        
        <div class="menu-grid">
            <div class="menu-card">
                <a href="lihat_absensi.php">
                    <div class="menu-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Lihat Absensi</div>
                        <div class="menu-description">Pantau kehadiran dan catatan absensi Anda</div>
                    </div>
                </a>
            </div>

            <div class="menu-card">
                <a href="lihat_gaji.php">
                    <div class="menu-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Lihat Gaji</div>
                        <div class="menu-description">Cek rincian gaji dan slip pembayaran</div>
                    </div>
                </a>
            </div>

            <div class="menu-card">
                <a href="ubah_profil.php">
                    <div class="menu-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Ubah Profil</div>
                        <div class="menu-description">Perbarui informasi profil Anda</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="logout-container">
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>
</body>
</html>
