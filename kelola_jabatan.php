<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua data jabatan
$query = "SELECT * FROM jabatan"; // Pastikan tabel ini ada di database Anda
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jabatan</title>
    <link href="kelola_jabatan.css" rel="stylesheet"> <!-- Menghubungkan file CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <h1>Kelola Jabatan</h1>
        <h2>Daftar Jabatan</h2>         
        <table class="pengguna-table">
            <tr>
                <th>ID Jabatan</th>
                <th>Nama Jabatan</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_jabatan']); ?></td> <!-- Pastikan nama field sesuai -->
                <td><?php echo htmlspecialchars($row['nama_jabatan']); ?></td> <!-- Pastikan nama field sesuai -->
                <td>
                    <a href="ubah_jabatan.php?id=<?php echo htmlspecialchars($row['id_jabatan']); ?>" class="button edit-btn">Edit</a> |
                    <a href="hapus_jabatan.php?id=<?php echo htmlspecialchars($row['id_jabatan']); ?>" class="button delete-btn" onclick="return confirm('Yakin ingin menghapus jabatan ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="tambah_jabatan.php" class="button add-btn">Tambah Jabatan</a>
        <a href="dashboard_admin.php" class="button back-btn">Kembali</a>
    </div>
</body>
</html>
