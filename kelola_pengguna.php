<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua data pengguna
$query = "SELECT p.*, k.*
FROM pengguna p
INNER JOIN karyawan k ON p.id_karyawan = k.id_karyawan";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi)); // Error handling
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Pengguna</title>
    <link href="kelola_pengguna.css" rel="stylesheet"> <!-- Menghubungkan file CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <h1>Kelola Pengguna</h1>
        <table class="pengguna-table">
            <tr>
                <th>Kode Karyawan</th>
                <th>Username</th>
                <th>Level</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['kode_karyawan']; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['level']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <a href="ubah_pengguna.php?id=<?php echo htmlspecialchars($row['username']); ?>" class="button edit-btn">Edit</a> |
                    <a href="hapus_pengguna.php?id=<?php echo htmlspecialchars($row['username']); ?>" class="button delete-btn" onclick="return confirm('Yakin ingin menghapus pengguna ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="button-container">
            <a href="tambah_pengguna.php" class="logout-btn">Tambah Pengguna Baru</a>
            <a href="dashboard_admin.php" class="logout-btn">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
