<?php
include('koneksi.php');
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}
$query_departemen = "SELECT * FROM departemen";
$result_departemen = mysqli_query($koneksi, $query_departemen);

// Ambil data dari tabel jabatan
$query_jabatan = "SELECT * FROM jabatan";
$result_jabatan = mysqli_query($koneksi, $query_jabatan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Karyawan</title>
</head>
<body>
    <h1>Tambah Karyawan</h1>
    <form method="POST" action="simpan_karyawan.php">
        <label>Kode Karyawan:</label>
        <input type="text" name="kode_karyawan" required><br>

        <label>Nama Karyawan:</label>
        <input type="text" name="nama_karyawan" required><br>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select><br>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tgl_lahir" required><br>

        <label>Alamat:</label>
        <textarea name="alamat" required></textarea><br>

        <label>No HP:</label>
        <input type="text" name="no_hp"><br>

        <label>Email:</label>
        <input type="email" name="email"><br>

        <label>Tanggal Masuk:</label>
        <input type="date" name="tgl_masuk" required><br>

        <label>Gaji Pokok:</label>
        <input type="number" name="gaji_pokok" required><br>

        <label>ID Departemen:</label>
        <select name="id_departemen" required>
            <option value="">Pilih Departemen</option>
            <?php while ($row = mysqli_fetch_assoc($result_departemen)) { ?>
                <option value="<?php echo htmlspecialchars($row['id_departemen']); ?>">
                    <?php echo htmlspecialchars($row['id_departemen'] . " - " . $row['nama_departemen']); ?>
                </option>
            <?php } ?>
        </select><br>

        <label>ID Jabatan:</label>
        <select name="id_jabatan" required>
            <option value="">Pilih Jabatan</option>
            <?php while ($row = mysqli_fetch_assoc($result_jabatan)) { ?>
                <option value="<?php echo htmlspecialchars($row['id_jabatan']); ?>">
                    <?php echo htmlspecialchars($row['id_jabatan'] . " - " . $row['nama_jabatan']); ?>
                </option>
            <?php } ?>
        </select><br>

        <label>Status Karyawan:</label>
        <select name="status_karyawan" required>
            <option value="Tetap">Tetap</option>
            <option value="Kontrak">Kontrak</option>
            <option value="Percobaan">Percobaan</option>
        </select><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
        </select><br>

        <input type="submit" value="Simpan">
    </form>
    <a href="kelola_karyawan.php">Kembali</a>
</body>
</html>
