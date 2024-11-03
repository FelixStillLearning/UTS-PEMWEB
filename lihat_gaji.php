<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Karyawan') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php'); // Menghubungkan ke database

// Ambil id_karyawan dari sesi
$id_karyawan = $_SESSION['id_karyawan'];

// Query untuk mendapatkan data gaji
$query = "SELECT * FROM gaji WHERE id_karyawan = '$id_karyawan' ORDER BY tahun DESC, bulan DESC";
$result = mysqli_query($koneksi, $query);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Gaji</title>
    <link rel="stylesheet" href="lihat_gaji.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Data Gaji Anda</h1>
        <table class="gaji-table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan Jabatan</th>
                    <th>Tunjangan Makan</th>
                    <th>Tunjangan Transport</th>
                    <th>Total Lembur</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Status Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['bulan']); ?></td>
                    <td><?php echo htmlspecialchars($row['tahun']); ?></td>
                    <td><?php echo htmlspecialchars($row['gaji_pokok']); ?></td>
                    <td><?php echo htmlspecialchars($row['tunjangan_jabatan']); ?></td>
                    <td><?php echo htmlspecialchars($row['tunjangan_makan']); ?></td>
                    <td><?php echo htmlspecialchars($row['tunjangan_transport']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_lembur']); ?></td>
                    <td><?php echo htmlspecialchars($row['potongan']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_gaji']); ?></td>
                    <td><?php echo htmlspecialchars($row['status_bayar']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="dashboard_karyawan.php" class="logout-btn">Kembali ke Dashboard</a>
    </div>
</body>
</html>
