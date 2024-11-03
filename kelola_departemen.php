<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua data departemen
$query = "SELECT * FROM departemen";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Departemen</title>
    <link href="kelola_departemen.css" rel="stylesheet"> <!-- Menghubungkan file CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <h1>Kelola Departemen</h1>
        <h2>Daftar Departemen</h2>         
        <table class="pengguna-table">
            <tr>
                <th>ID Departemen</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_departemen']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_departemen']); ?></td>
                <td>
                    <a href="ubah_departemen.php?id=<?php echo htmlspecialchars($row['id_departemen']); ?>" class="button edit-btn">Edit</a> |
                    <a href="hapus_departemen.php?id=<?php echo htmlspecialchars($row['id_departemen']); ?>" class="button delete-btn" onclick="return confirm('Yakin ingin menghapus departemen ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="tambah_departemen.php" class="button add-btn">Tambah Departemen</a>
        <a href="dashboard_admin.php" class="button back-btn">Kembali</a>

    </div>
</body>
</html>
