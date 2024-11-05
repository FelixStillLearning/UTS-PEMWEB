<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID gaji dari URL
$id_gaji = $_GET['id'];

// Query untuk mendapatkan data gaji berdasarkan ID
$query = "SELECT * FROM gaji WHERE id_gaji = '$id_gaji'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "Data gaji tidak ditemukan.";
    exit();
}

// Ambil semua karyawan untuk ditampilkan di dropdown
$query_karyawan = "SELECT * FROM karyawan";
$result_karyawan = mysqli_query($koneksi, $query_karyawan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Gaji</title>
    <link rel="stylesheet" href="ubah_gaji.css">
</head>
<body>
    <div class="form-container">
        <h1>Edit Gaji</h1>
        <form action="update_gaji.php" method="post">
            <input type="hidden" name="id_gaji" value="<?php echo htmlspecialchars($data['id_gaji']); ?>">

            <div class="form-group">
                <label for="id_karyawan">Karyawan:</label>
                <select name="id_karyawan" id="id_karyawan" required>
                    <?php while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) { ?>
                        <option value="<?php echo htmlspecialchars($row_karyawan['id_karyawan']); ?>" 
                            <?php echo $row_karyawan['id_karyawan'] == $data['id_karyawan'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row_karyawan['nama_karyawan']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="bulan">Bulan:</label>
                <input type="number" id="bulan" name="bulan" min="1" max="12" value="<?php echo htmlspecialchars($data['bulan']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun:</label>
                <input type="number" id="tahun" name="tahun" min="2000" value="<?php echo htmlspecialchars($data['tahun']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gaji_pokok">Gaji Pokok:</label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" value="<?php echo htmlspecialchars($data['gaji_pokok']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tunjangan_jabatan">Tunjangan Jabatan:</label>
                <input type="number" id="tunjangan_jabatan" name="tunjangan_jabatan" value="<?php echo htmlspecialchars($data['tunjangan_jabatan']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tunjangan_makan">Tunjangan Makan:</label>
                <input type="number" id="tunjangan_makan" name="tunjangan_makan" value="<?php echo htmlspecialchars($data['tunjangan_makan']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tunjangan_transport">Tunjangan Transport:</label>
                <input type="number" id="tunjangan_transport" name="tunjangan_transport" value="<?php echo htmlspecialchars($data['tunjangan_transport']); ?>" required>
            </div>

            <div class="form-group">
                <label for="potongan">Potongan:</label>
                <input type="number" id="potongan" name="potongan" value="<?php echo htmlspecialchars($data['potongan']); ?>" required>
            </div>

            <div class="form-group">
                <label for="total_gaji">Total Gaji:</label>
                <input type="number" id="total_gaji" name="total_gaji" value="<?php echo htmlspecialchars($data['total_gaji']); ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Bayar:</label>
                <input type="date" id="tanggal_bayar" name="tanggal_bayar" value="<?php echo htmlspecialchars($data['tanggal_bayar']); ?>">
            </div>

            <div class="form-group">
                <label for="status_bayar">Status Bayar:</label>
                <select name="status_bayar" id="status_bayar">
                    <option value="Draft" <?php echo $data['status_bayar'] == 'Draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="Disetujui" <?php echo $data['status_bayar'] == 'Disetujui' ? 'selected' : ''; ?>>Disetujui</option>
                    <option value="Dibayar" <?php echo $data['status_bayar'] == 'Dibayar' ? 'selected' : ''; ?>>Dibayar</option>
                </select>
            </div>

            <div class="form-actions">
                <input type="submit" class="button update-btn" value="Update">
            </div>
        </form>
        <a href="kelola_gaji.php" class="button back-btn">Kembali</a>
    </div>
</body>
</html>
