<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua data lembur
$query = "SELECT l.*, k.nama_karyawan, k.kode_karyawan FROM lembur l JOIN karyawan k ON l.id_karyawan = k.id_karyawan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kelola_lembur.css"> <!-- Link ke file CSS -->
    <title>Kelola Lembur</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Kelola Lembur</h1>

        <!-- Tambahkan tombol untuk menambah data lembur -->
        <div class="button-container">
            <a class="button add-btn" href="tambah_lembur.php">Tambah Lembur</a>
        </div>
        <br>

        <table class="pengguna-table">
            <tr>
                <th>Kode Karyawan</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Lembur</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Total Jam</th>
                <th>Tarif per Jam</th>
                <th>Total Lembur</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['kode_karyawan']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_karyawan']); ?></td>
                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                <td><?php echo htmlspecialchars($row['jam_mulai']); ?></td>
                <td><?php echo htmlspecialchars($row['jam_selesai']); ?></td>
                <td><?php echo htmlspecialchars($row['total_jam']); ?></td>
                <td><?php echo htmlspecialchars($row['tarif_perjam']); ?></td>
                <td><?php echo htmlspecialchars($row['total_lembur']); ?></td>
                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                <td>
                    <a class="button edit-btn" href="ubah_lembur.php?id=<?php echo $row['id_lembur']; ?>&id_karyawan=<?php echo $row['id_karyawan']; ?>">Edit</a> |
                    <a class="button delete-btn" href="hapus_lembur.php?id=<?php echo $row['id_lembur']; ?>&id_karyawan=<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Yakin ingin menghapus data lembur ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a class="button back-btn" href="dashboard_hrd.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>
