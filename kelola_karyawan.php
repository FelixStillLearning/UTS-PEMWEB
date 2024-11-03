<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Query untuk mengambil data karyawan, termasuk kode karyawan
$query = "SELECT * FROM karyawan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Karyawan</title>
</head>
<body>
    <h1>Kelola Karyawan</h1>
    <a href="tambah_karyawan.php">Tambah Karyawan</a>
    <table border="1">
        <tr>
            <th>Kode Karyawan</th> <!-- Ubah header ID Karyawan menjadi Kode Karyawan -->
            <th>Nama Karyawan</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Tanggal Masuk</th>
            <th>Gaji Pokok</th>
            <th>Status Karyawan</th>
            <th>Status</th>
            <th>ID Departemen</th>
            <th>ID Jabatan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['kode_karyawan']); ?></td> <!-- Tampilkan kode karyawan -->
            <td><?php echo htmlspecialchars($row['nama_karyawan']); ?></td>
            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
            <td><?php echo htmlspecialchars($row['tgl_lahir']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['tgl_masuk']); ?></td>
            <td><?php echo htmlspecialchars($row['gaji_pokok']); ?></td>
            <td><?php echo htmlspecialchars($row['status_karyawan']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td><?php echo htmlspecialchars($row['id_departemen']); ?></td>
            <td><?php echo htmlspecialchars($row['id_jabatan']); ?></td>
            <td>
                <a href="ubah_karyawan.php?id=<?php echo $row['id_karyawan']; ?>">Edit</a>
                <a href="hapus_karyawan.php?id=<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="dashboard_hrd.php">Kembali ke Dashboard</a>
</body>
</html>
