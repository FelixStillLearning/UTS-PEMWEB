<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_karyawan = $_POST['id_karyawan'];
    $tanggal = $_POST['tanggal'];
    $jam_masuk = $_POST['jam_masuk'] ?: null; // Use NULL if not filled
    $jam_keluar = $_POST['jam_keluar'] ?: null; // Use NULL if not filled
    $status_hadir = $_POST['status_hadir'];
    $keterangan = $_POST['keterangan'] ?: null; // Use NULL if not filled

    // Query to insert data into the absensi table
    $query = "INSERT INTO absensi (id_karyawan, tanggal, jam_masuk, jam_keluar, status_hadir, keterangan) 
              VALUES ('$id_karyawan', '$tanggal', '$jam_masuk', '$jam_keluar', '$status_hadir', '$keterangan')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: kelola_absensi.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Query to fetch karyawan data
$query_karyawan = "SELECT * FROM karyawan";
$result_karyawan = mysqli_query($koneksi, $query_karyawan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Absensi</title>
    <link rel="stylesheet" href="tambah_absensi.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Tambah Absensi</h1>
        <form method="POST" action="">
            <label>ID Karyawan:</label>
            <select name="id_karyawan" required>
                <option value="">Pilih Karyawan</option>
                <?php while ($row = mysqli_fetch_assoc($result_karyawan)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id_karyawan']); ?>">
                        <?php echo htmlspecialchars($row['id_karyawan'] . " - " . $row['nama_karyawan']); ?>
                    </option>
                <?php } ?>
            </select>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required>
            <label>Jam Masuk:</label>
            <input type="time" name="jam_masuk">
            <label>Jam Keluar:</label>
            <input type="time" name="jam_keluar">
            <label>Status Kehadiran:</label>
            <select name="status_hadir" required>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alpa">Alpa</option>
            </select>
            <label>Keterangan:</label>
            <textarea name="keterangan"></textarea>
            <input type="submit" class="button save-btn" value="Simpan">
        </form>
        <a href="kelola_absensi.php" class="button back-btn">Kembali</a>
    </div>
</body>
</html>
