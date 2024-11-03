<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil semua karyawan untuk ditampilkan di dropdown
$query = "SELECT * FROM karyawan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Gaji</title>
</head>
<body>
    <h1>Tambah Gaji</h1>
    <form action="simpan_gaji.php" method="post">
        <label>Karyawan:</label>
        <select name="id_karyawan" required>
            <option value="">Pilih Karyawan</option>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo htmlspecialchars($row['id_karyawan']); ?>">
                    <?php echo htmlspecialchars($row['nama_karyawan']); ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Bulan:</label>
        <input type="number" name="bulan" min="1" max="12" required><br><br>

        <label>Tahun:</label>
        <input type="number" name="tahun" min="2000" required><br><br>

        <label>Gaji Pokok:</label>
        <input type="number" name="gaji_pokok" required><br><br>

        <label>Tunjangan Jabatan:</label>
        <input type="number" name="tunjangan_jabatan" required><br><br>

        <label>Tunjangan Makan:</label>
        <input type="number" name="tunjangan_makan" required><br><br>

        <label>Tunjangan Transport:</label>
        <input type="number" name="tunjangan_transport" required><br><br>

        <label>Potongan:</label>
        <input type="number" name="potongan" required><br><br>

        <label>Tanggal Bayar:</label>
        <input type="date" name="tanggal_bayar" required><br><br>

        <label>Status Bayar:</label>
        <select name="status_bayar" required>
            <option value="Draft">Draft</option>
            <option value="Disetujui">Disetujui</option>
            <option value="Dibayar">Dibayar</option>
        </select><br><br>

        <input type="submit" value="Simpan">
    </form>
    <a href="kelola_gaji.php">Kembali</a>
</body>
</html>
