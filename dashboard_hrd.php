
<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard HRD</title>
    <link href="dashboard_hrd.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
            <p>Kelola data dan informasi karyawan</p>
        </div>
        
        <div class="menu-grid">
            <div class="menu-card">
                <a href="kelola_absensi.php">
                    <div class="menu-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Kelola Absensi</div>
                        <div class="menu-description">Monitor dan kelola kehadiran karyawan</div>
                    </div>
                </a>
            </div>

            <div class="menu-card">
                <a href="kelola_lembur.php">
                    <div class="menu-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Kelola Lembur</div>
                        <div class="menu-description">Atur dan verifikasi data lembur</div>
                    </div>
                </a>
            </div>

            <div class="menu-card">
                <a href="kelola_gaji.php">
                    <div class="menu-icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Kelola Gaji</div>
                        <div class="menu-description">Proses dan kelola penggajian</div>
                    </div>
                </a>
            </div>

            <div class="menu-card">
                <a href="kelola_karyawan.php">
                    <div class="menu-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Kelola Karyawan</div>
                        <div class="menu-description">Atur data dan profil karyawan</div>
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
