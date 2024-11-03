<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Karyawan') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php'); // Menghubungkan ke database

// Ambil id_karyawan dari sesi
$id_karyawan = $_SESSION['id_karyawan'];

// Query untuk mendapatkan data karyawan
$query = "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'";
$result = mysqli_query($koneksi, $query);
$karyawan = mysqli_fetch_assoc($result);

// Update data profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_karyawan = $_POST['nama_karyawan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];

    $update_query = "UPDATE karyawan SET nama_karyawan = '$nama_karyawan', alamat = '$alamat', no_hp = '$no_hp', email = '$email' WHERE id_karyawan = '$id_karyawan'";
    if (mysqli_query($koneksi, $update_query)) {
        echo "Profil berhasil diupdate.";
    } else {
        echo "Terjadi kesalahan saat mengupdate profil.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Profil</title>
    <link rel="stylesheet" type="text/css" href="ubah_profil.css">
</head>
<body>
    <div class="container">
        <h1>Ubah Profil Anda</h1>
        <form method="POST" class="profile-form">
            <label>Nama Karyawan:</label>
            <input type="text" name="nama_karyawan" value="<?php echo htmlspecialchars($karyawan['nama_karyawan']); ?>" required><br>
            <label>Alamat:</label>
            <textarea name="alamat" required><?php echo htmlspecialchars($karyawan['alamat']); ?></textarea><br>
            <label>No HP:</label>
            <input type="text" name="no_hp" value="<?php echo htmlspecialchars($karyawan['no_hp']); ?>"><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($karyawan['email']); ?>"><br>
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>
        <a href="dashboard_karyawan.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>


</html>
