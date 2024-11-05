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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <link rel="stylesheet" type="text/css" href="tambah_karyawan.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Karyawan</h1>
        <form method="POST" action="simpan_karyawan.php">
            <label for="kode_karyawan">Kode Karyawan:</label>
            <input type="text" id="kode_karyawan" name="kode_karyawan" required><br>

            <label for="nama_karyawan">Nama Karyawan:</label>
            <input type="text" id="nama_karyawan" name="nama_karyawan" required><br>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select><br>

            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required><br>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea><br>

            <label for="no_hp">No HP:</label>
            <input type="text" id="no_hp" name="no_hp"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <label for="tgl_masuk">Tanggal Masuk:</label>
            <input type="date" id="tgl_masuk" name="tgl_masuk" required><br>

            <label for="gaji_pokok">Gaji Pokok:</label>
            <input type="number" id="gaji_pokok" name="gaji_pokok" required><br>

            <label for="id_departemen">ID Departemen:</label>
            <select id="id_departemen" name="id_departemen" required>
                <option value="">Pilih Departemen</option>
                <?php while ($row = mysqli_fetch_assoc($result_departemen)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id_departemen']); ?>">
                        <?php echo htmlspecialchars($row['id_departemen'] . " - " . $row['nama_departemen']); ?>
                    </option>
                <?php } ?>
            </select><br>

            <label for="id_jabatan">ID Jabatan:</label>
            <select id="id_jabatan" name="id_jabatan" required>
                <option value="">Pilih Jabatan</option>
                <?php while ($row = mysqli_fetch_assoc($result_jabatan)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id_jabatan']); ?>">
                        <?php echo htmlspecialchars($row['id_jabatan'] . " - " . $row['nama_jabatan']); ?>
                    </option>
                <?php } ?>
            </select><br>

            <label for="status_karyawan">Status Karyawan:</label>
            <select id="status_karyawan" name="status_karyawan" required>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Percobaan">Percobaan</option>
            </select><br>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select><br>

            <button type="submit" class="button edit-btn">Simpan Karyawan</button>
        </form>
        <a href="kelola_karyawan.php" class="button logout-btn">Kembali</a>
    </div>
</body>
</html>
