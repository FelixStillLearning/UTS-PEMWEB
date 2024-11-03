<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil data karyawan untuk dropdown
$queryKaryawan = "SELECT * FROM karyawan";
$resultKaryawan = mysqli_query($koneksi, $queryKaryawan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Lembur</title>
</head>
<body>
    <h1>Tambah Lembur</h1>
    <form method="POST" action="simpan_lembur.php">
        <label>ID Karyawan:</label>
        <select name="id_karyawan" required>
            <option value="">Pilih Karyawan</option>
            <?php while ($row = mysqli_fetch_assoc($resultKaryawan)) { ?>
                <option value="<?php echo htmlspecialchars($row['id_karyawan']); ?>">
                    <?php echo htmlspecialchars($row['nama_karyawan']); ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Tanggal Lembur:</label>
        <input type="date" name="tanggal" required><br><br>

        <label>Jam Mulai:</label>
        <input type="time" name="jam_mulai" required><br><br>

        <label>Jam Selesai:</label>
        <input type="time" name="jam_selesai" required><br><br>

        <label>Tarif per Jam:</label>
        <input type="number" name="tarif_perjam" required><br><br>

        <label>Keterangan:</label>
        <textarea name="keterangan"></textarea><br><br>

        <input type="submit" value="Simpan">
    </form>
    <a href="update_lembur.php">Kembali</a>
</body>
</html>
