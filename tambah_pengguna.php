<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Query untuk mengambil data kode karyawan dari tabel karyawan
$query_karyawan = "SELECT kode_karyawan, nama_karyawan, id_karyawan FROM karyawan";
$result_karyawan = mysqli_query($koneksi, $query_karyawan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <link href="tambah_pengguna.css" rel="stylesheet"> <!-- Menghubungkan file CSS -->
</head>
<body>
    <div class="form-container">
        <h1>Tambah Pengguna Baru</h1>
        <form action="simpan_pengguna.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required aria-label="Username">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required aria-label="Password">
            
            <label for="kode_id_karyawan">Kode Karyawan:</label>
            <select id="kode_id_karyawan" name="kode_id_karyawan" required aria-label="Kode Karyawan">
                <option value="">Pilih Kode Karyawan</option>
                <?php while ($row = mysqli_fetch_assoc($result_karyawan)) { ?>
                    <option value="<?php echo htmlspecialchars($row['kode_karyawan'] . ',' . $row['id_karyawan']); ?>">
                        <?php echo htmlspecialchars($row['kode_karyawan'] . " - " . $row['nama_karyawan']); ?>
                    </option>
                <?php } ?>
            </select>
            
            <label for="level">Level:</label>
            <select id="level" name="level" required aria-label="Level">
                <option value="Admin">Admin</option>
                <option value="HRD">HRD</option>
                <option value="Karyawan">Karyawan</option>
            </select>
            
            <label for="status">Status:</label>
            <select id="status" name="status" aria-label="Status">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
            
            <input type="submit" value="Tambah Pengguna">
        </form>
        <a href="kelola_pengguna.php" class="button">Kembali</a>
    </div>
</body>
</html>
