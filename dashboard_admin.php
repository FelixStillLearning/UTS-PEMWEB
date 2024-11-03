<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="dashboard_admin.css" rel="stylesheet">
    <!-- Tambahkan Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <div class="status-message status-admin">
            Selamat datang, Admin <?php echo $_SESSION['username']; ?>!
        </div>
        
        <h1>Dashboard Admin</h1>
        <p>Kelola sistem dan pengaturan website Anda</p>
        
        <ul>
            <li>
                <a href="kelola_pengguna.php">
                    <i class="fas fa-users menu-icon"></i>
                    Kelola Pengguna
                </a>
            </li>
            <li>
                <a href="kelola_departemen.php">
                    <i class="fas fa-building menu-icon"></i>
                    Kelola Departemen
                </a>
            </li>
            <li>
                <a href="kelola_jabatan.php">
                    <i class="fas fa-id-badge menu-icon"></i>
                    Kelola Jabatan
                </a>
            </li>
        </ul>

        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</body>
</html>
