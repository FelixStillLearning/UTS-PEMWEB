<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Karyawan') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php'); // Menghubungkan ke database

// Ambil id_karyawan dari sesi dengan benar
$id_karyawan = $_SESSION['id_karyawan']; 

// Query untuk mendapatkan data absensi
$query = "SELECT * FROM absensi WHERE id_karyawan = '$id_karyawan' ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Absensi</title>
    <link rel="stylesheet" href="lihat_absensi.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Data Absensi Anda</h1>
        <table class="absensi-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status Hadir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data dari database
                while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                    <td><?php echo htmlspecialchars($row['jam_masuk']); ?></td>
                    <td><?php echo htmlspecialchars($row['jam_keluar']); ?></td>
                    <td><?php echo htmlspecialchars($row['status_hadir']); ?></td>
                    <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="dashboard_karyawan.php" class="logout-btn">Kembali ke Dashboard</a>
    </div>
</body>
</html>