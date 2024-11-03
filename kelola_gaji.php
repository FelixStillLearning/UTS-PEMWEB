<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua data gaji, termasuk kode karyawan
$query = "SELECT g.id_gaji, k.kode_karyawan, k.nama_karyawan, g.bulan, g.tahun, g.gaji_pokok, 
          g.tunjangan_jabatan, g.tunjangan_makan, g.tunjangan_transport, g.potongan, 
          g.total_gaji, g.tanggal_bayar, g.status_bayar 
          FROM gaji g
          JOIN karyawan k ON g.id_karyawan = k.id_karyawan"; 
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Gaji</title>
</head>
<body>
    <h1>Kelola Gaji</h1>
    <table border="1">
        <tr>
            <th>Kode Karyawan</th>
            <th>Nama Karyawan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Gaji Pokok</th>
            <th>Tunjangan Jabatan</th>
            <th>Tunjangan Makan</th>
            <th>Tunjangan Transport</th>
            <th>Potongan</th>
            <th>Total Gaji</th>
            <th>Tanggal Bayar</th>
            <th>Status Bayar</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['kode_karyawan'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['nama_karyawan'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['bulan'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['tahun'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['gaji_pokok'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['tunjangan_jabatan'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['tunjangan_makan'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['tunjangan_transport'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['potongan'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['total_gaji'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['tanggal_bayar'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['status_bayar'] ?? ''); ?></td>
            <td>
                <a href="ubah_gaji.php?id=<?php echo htmlspecialchars($row['id_gaji']); ?>">Edit</a> |
                <a href="hapus_gaji.php?id=<?php echo htmlspecialchars($row['id_gaji']); ?>" onclick="return confirm('Yakin ingin menghapus data gaji ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="tambah_gaji.php">Tambah Gaji</a> | <a href="dashboard_hrd.php">Kembali ke Dashboard</a>
</body>
</html>
