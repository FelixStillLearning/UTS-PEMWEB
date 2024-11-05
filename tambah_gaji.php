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
    <link rel="stylesheet" href="tambah_gaji.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Tambah Gaji</h1>
        <form action="simpan_gaji.php" method="post">
            <div>
                <label for="id_karyawan">Karyawan:</label>
                <select name="id_karyawan" id="id_karyawan" required>
                    <option value="">Pilih Karyawan</option>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo htmlspecialchars($row['id_karyawan']); ?>">
                            <?php echo htmlspecialchars($row['nama_karyawan']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="bulan">Bulan:</label>
                <input type="number" id="bulan" name="bulan" min="1" max="12" required>
            </div>

            <div>
                <label for="tahun">Tahun:</label>
                <input type="number" id="tahun" name="tahun" min="2000" required>
            </div>

            <div>
                <label for="gaji_pokok">Gaji Pokok:</label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" required>
            </div>

            <div>
                <label for="tunjangan_jabatan">Tunjangan Jabatan:</label>
                <input type="number" id="tunjangan_jabatan" name="tunjangan_jabatan" required>
            </div>

            <div>
                <label for="tunjangan_makan">Tunjangan Makan:</label>
                <input type="number" id="tunjangan_makan" name="tunjangan_makan" required>
            </div>

            <div>
                <label for="tunjangan_transport">Tunjangan Transport:</label>
                <input type="number" id="tunjangan_transport" name="tunjangan_transport" required>
            </div>

            <div>
                <label for="potongan">Potongan:</label>
                <input type="number" id="potongan" name="potongan" required>
            </div>

            <div>
                <label for="tanggal_bayar">Tanggal Bayar:</label>
                <input type="date" id="tanggal_bayar" name="tanggal_bayar" required>
            </div>

            <div>
                <label for="status_bayar">Status Bayar:</label>
                <select name="status_bayar" id="status_bayar" required>
                    <option value="Draft">Draft</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Dibayar">Dibayar</option>
                </select>
            </div>

            <div>
                <input type="submit" class="button edit-btn" value="Simpan">
            </div>
        </form>
        <a href="kelola_gaji.php" class="button logout-btn">Kembali</a>
    </div>
</body>
</html>
