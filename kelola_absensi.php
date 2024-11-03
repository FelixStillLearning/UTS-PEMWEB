<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua data absensi
$query = "SELECT a.*, k.nama_karyawan, k.kode_karyawan FROM absensi a JOIN karyawan k ON a.id_karyawan = k.id_karyawan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Absensi</title>
</head>
<body>
    <h1>Kelola Absensi</h1>

    <!-- Tambahkan tombol untuk menambah data absensi -->
    <a href="tambah_absensi.php">Tambah Absensi</a>
    <br><br>

    <table border="1">
        <tr>
            <th>kode Karyawan</th>
            <th>Nama Karyawan</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Status Kehadiran</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['kode_karyawan']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_karyawan']); ?></td>
            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
            <td><?php echo htmlspecialchars($row['jam_masuk']); ?></td>
            <td><?php echo htmlspecialchars($row['jam_keluar']); ?></td>
            <td><?php echo htmlspecialchars($row['status_hadir']); ?></td>
            <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
            <td>
                <a href="ubah_absensi.php?id=<?php echo $row['id_absensi']; ?>">Edit</a> |
                <a href="hapus_absensi.php?id=<?php echo $row['id_absensi']; ?>" onclick="return confirm('Yakin ingin menghapus data absensi ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="dashboard_hrd.php">Kembali ke Dashboard</a>
</body>
</html>
