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
</head>
<body>
    <h1>Edit Gaji</h1>
    <form action="update_gaji.php" method="post">
        <input type="hidden" name="id_gaji" value="<?php echo htmlspecialchars($data['id_gaji']); ?>">

        <label>Karyawan:</label>
        <select name="id_karyawan" required>
            <?php while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) { ?>
                <option value="<?php echo htmlspecialchars($row_karyawan['id_karyawan']); ?>" 
                    <?php echo $row_karyawan['id_karyawan'] == $data['id_karyawan'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row_karyawan['nama_karyawan']); ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Bulan:</label>
        <input type="number" name="bulan" min="1" max="12" value="<?php echo htmlspecialchars($data['bulan']); ?>" required><br><br>

        <label>Tahun:</label>
        <input type="number" name="tahun" min="2000" value="<?php echo htmlspecialchars($data['tahun']); ?>" required><br><br>

        <label>Gaji Pokok:</label>
        <input type="number" name="gaji_pokok" value="<?php echo htmlspecialchars($data['gaji_pokok']); ?>" required><br><br>

        <label>Tunjangan Jabatan:</label>
        <input type="number" name="tunjangan_jabatan" value="<?php echo htmlspecialchars($data['tunjangan_jabatan']); ?>" required><br><br>

        <label>Tunjangan Makan:</label>
        <input type="number" name="tunjangan_makan" value="<?php echo htmlspecialchars($data['tunjangan_makan']); ?>" required><br><br>

        <label>Tunjangan Transport:</label>
        <input type="number" name="tunjangan_transport" value="<?php echo htmlspecialchars($data['tunjangan_transport']); ?>" required><br><br>

        <label>Potongan:</label>
        <input type="number" name="potongan" value="<?php echo htmlspecialchars($data['potongan']); ?>" required><br><br>

        <label>Total Gaji:</label>
        <input type="number" name="total_gaji" value="<?php echo htmlspecialchars($data['total_gaji']); ?>" required readonly><br><br>

        <label>Tanggal Bayar:</label>
        <input type="date" name="tanggal_bayar" value="<?php echo htmlspecialchars($data['tanggal_bayar']); ?>"><br><br>

        <label>Status Bayar:</label>
        <select name="status_bayar">
            <option value="Draft" <?php echo $data['status_bayar'] == 'Draft' ? 'selected' : ''; ?>>Draft</option>
            <option value="Disetujui" <?php echo $data['status_bayar'] == 'Disetujui' ? 'selected' : ''; ?>>Disetujui</option>
            <option value="Dibayar" <?php echo $data['status_bayar'] == 'Dibayar' ? 'selected' : ''; ?>>Dibayar</option>
        </select><br><br>

        <input type="submit" value="Update">
    </form>
    <a href="kelola_gaji.php">Kembali</a>
</body>
</html>
