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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tambah_lembur.css"> <!-- Link to the same CSS file -->
    <title>Tambah Lembur</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Tambah Lembur</h1>
        <form method="POST" action="simpan_lembur.php">
            <div class="form-group">
                <label for="id_karyawan">ID Karyawan:</label>
                <select name="id_karyawan" required>
                    <option value="">Pilih Karyawan</option>
                    <?php while ($row = mysqli_fetch_assoc($resultKaryawan)) { ?>
                        <option value="<?php echo htmlspecialchars($row['id_karyawan']); ?>">
                            <?php echo htmlspecialchars($row['nama_karyawan']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Lembur:</label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai:</label>
                <input type="time" name="jam_mulai" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai:</label>
                <input type="time" name="jam_selesai" required>
            </div>
            <div class="form-group">
                <label for="tarif_perjam">Tarif per Jam:</label>
                <input type="number" name="tarif_perjam" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea name="keterangan"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="button add-btn" value="Simpan">
            </div>
        </form>
        <a class="button back-btn" href="kelola_lembur.php">Kembali</a>
    </div>
</body>
</html>
