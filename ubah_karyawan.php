<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID karyawan dari URL
$id_karyawan = $_GET['id'];

// Query untuk mengambil data karyawan berdasarkan ID
$query = "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Karyawan</title>
</head>
<body>
    <h1>Ubah Karyawan</h1>
    <form method="POST" action="update_karyawan.php">
        <input type="hidden" name="id_karyawan" value="<?php echo htmlspecialchars($row['id_karyawan']); ?>">

        <label>Nama Karyawan:</label>
        <input type="text" name="nama_karyawan" value="<?php echo htmlspecialchars($row['nama_karyawan']); ?>" required><br>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="L" <?php if ($row['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
            <option value="P" <?php if ($row['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
        </select><br>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tgl_lahir" value="<?php echo htmlspecialchars($row['tgl_lahir']); ?>" required><br>

        <label>Alamat:</label>
        <textarea name="alamat" required><?php echo htmlspecialchars($row['alamat']); ?></textarea><br>

        <label>No HP:</label>
        <input type="text" name="no_hp" value="<?php echo htmlspecialchars($row['no_hp']); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>

        <label>Tanggal Masuk:</label>
        <input type="date" name="tgl_masuk" value="<?php echo htmlspecialchars($row['tgl_masuk']); ?>" required><br>

        <label>Departemen:</label>
        <input type="number" name="id_departemen" value="<?php echo htmlspecialchars($row['id_departemen']); ?>" required><br>

        <label>Jabatan:</label>
        <input type="number" name="id_jabatan" value="<?php echo htmlspecialchars($row['id_jabatan']); ?>" required><br>

        <label>Gaji Pokok:</label>
        <input type="number" name="gaji_pokok" value="<?php echo htmlspecialchars($row['gaji_pokok']); ?>" required><br>

        <label>Status Karyawan:</label>
        <select name="status_karyawan" required>
            <option value="Tetap" <?php if ($row['status_karyawan'] == 'Tetap') echo 'selected'; ?>>Tetap</option>
            <option value="Kontrak" <?php if ($row['status_karyawan'] == 'Kontrak') echo 'selected'; ?>>Kontrak</option>
            <option value="Percobaan" <?php if ($row['status_karyawan'] == 'Percobaan') echo 'selected'; ?>>Percobaan</option>
        </select><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Aktif" <?php if ($row['status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
            <option value="Tidak Aktif" <?php if ($row['status'] == 'Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
        </select><br>

        <input type="submit" value="Update">
    </form>
    <a href="kelola_karyawan.php">Kembali</a>
</body>
</html>
