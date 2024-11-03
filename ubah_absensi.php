<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID absensi dari URL
$id_absensi = $_GET['id'];

// Ambil data absensi berdasarkan ID
$query = "SELECT a.*, k.nama_karyawan, k.kode_karyawan FROM absensi a JOIN karyawan k ON a.id_karyawan = k.id_karyawan WHERE a.id_absensi = '$id_absensi'";
$result = mysqli_query($koneksi, $query);
$absensi = mysqli_fetch_assoc($result);

// Jika data absensi tidak ditemukan
if (!$absensi) {
    echo "Data absensi tidak ditemukan!";
    exit();
}

// Proses ketika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_karyawan = $_POST['id_karyawan']; // This should be the integer ID
    $tanggal = $_POST['tanggal'];
    $status_hadir = $_POST['status_hadir'];

    // Update data absensi
    $query_update = "UPDATE absensi SET 
                     id_karyawan = '$id_karyawan', 
                     tanggal = '$tanggal', 
                     status_hadir = '$status_hadir' 
                     WHERE id_absensi = '$id_absensi'";

    if (mysqli_query($koneksi, $query_update)) {
        // Jika update berhasil, kembali ke halaman kelola_absensi.php
        header("Location: kelola_absensi.php");
        exit();
    } else {
        echo "Gagal mengupdate data absensi!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Absensi</title>
</head>
<body>
    <h1>Edit Absensi</h1>
    <form method="POST">
        <label>ID Karyawan:</label>
        <input type="hidden" name="id_karyawan" value="<?php echo htmlspecialchars($absensi['id_karyawan']); ?>" required><br>
        <input type="text" value="<?php echo htmlspecialchars($absensi['kode_karyawan']); ?>" required readonly><br>

        <label>Nama Karyawan:</label>
        <input type="text" name="nama_karyawan" value="<?php echo htmlspecialchars($absensi['nama_karyawan']); ?>" required readonly><br>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" value="<?php echo htmlspecialchars($absensi['tanggal']); ?>" required><br>

        <label>Status Kehadiran:</label>
        <select name="status_hadir" required>
            <option value="Hadir" <?php if ($absensi['status_hadir'] === 'Hadir') echo 'selected'; ?>>Hadir</option>
            <option value="Izin" <?php if ($absensi['status_hadir'] === 'Izin') echo 'selected'; ?>>Izin</option>
            <option value="Sakit" <?php if ($absensi['status_hadir'] === 'Sakit') echo 'selected'; ?>>Sakit</option>
            <option value="Alpa" <?php if ($absensi['status_hadir'] === 'Alpa') echo 'selected'; ?>>Alpa</option>
        </select><br>

        <button type="submit">Update Absensi</button>
    </form>
    <br>
    <a href="kelola_absensi.php">Kembali ke Kelola Absensi</a>
</body>
</html>
