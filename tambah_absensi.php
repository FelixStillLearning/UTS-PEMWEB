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
    $jam_masuk = $_POST['jam_masuk'] ?: null; // Menggunakan NULL jika tidak diisi
    $jam_keluar = $_POST['jam_keluar'] ?: null; // Menggunakan NULL jika tidak diisi
    $status_hadir = $_POST['status_hadir'];
    $keterangan = $_POST['keterangan'] ?: null; // Menggunakan NULL jika tidak diisi

    // Query untuk menyimpan data ke tabel absensi
    $query = "INSERT INTO absensi (id_karyawan, tanggal, jam_masuk, jam_keluar, status_hadir, keterangan) 
              VALUES ('$id_karyawan', '$tanggal', '$jam_masuk', '$jam_keluar', '$status_hadir', '$keterangan')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: kelola_absensi.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Query untuk mengambil data karyawan
$query_karyawan = "SELECT * FROM karyawan";
$result_karyawan = mysqli_query($koneksi, $query_karyawan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Absensi</title>
</head>
<body>
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
        </select><br><br>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required><br><br>

        <label>Jam Masuk:</label>
        <input type="time" name="jam_masuk"><br><br>

        <label>Jam Keluar:</label>
        <input type="time" name="jam_keluar"><br><br>

        <label>Status Kehadiran:</label>
        <select name="status_hadir" required>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpa">Alpa</option>
        </select><br><br>

        <label>Keterangan:</label>
        <textarea name="keterangan"></textarea><br><br>

        <input type="submit" value="Simpan">
    </form>
    <a href="kelola_absensi.php">Kembali</a>
</body>
</html>
