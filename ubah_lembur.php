<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID lembur dari URL
$id_lembur = $_GET['id'];

// Query untuk mengambil data lembur berdasarkan ID
$query = "SELECT * FROM lembur WHERE id_lembur='$id_lembur'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Lembur</title>
</head>
<body>
    <h1>Ubah Lembur</h1>
    <form action="update_lembur.php" method="POST">
        <input type="hidden" name="id_lembur" value="<?php echo htmlspecialchars($row['id_lembur']); ?>">
        
        <label>ID Karyawan:</label>
        <input type="text" name="id_karyawan" value="<?php echo htmlspecialchars($row['id_karyawan']); ?>" required><br>
        
        <label>Tanggal Lembur:</label>
        <input type="date" name="tanggal_lembur" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required><br>
        
        <label>Jam Mulai:</label>
        <input type="time" name="jam_mulai" value="<?php echo htmlspecialchars($row['jam_mulai']); ?>" required><br>
        
        <label>Jam Selesai:</label>
        <input type="time" name="jam_selesai" value="<?php echo htmlspecialchars($row['jam_selesai']); ?>" required><br>
        
        <label>Tarif per Jam:</label>
        <input type="number" name="tarif_perjam" value="<?php echo htmlspecialchars($row['tarif_perjam']); ?>" required><br>
        
        <label>Keterangan:</label>
        <textarea name="keterangan"><?php echo htmlspecialchars($row['keterangan']); ?></textarea><br>
        
        <input type="submit" value="Update">
    </form>
    <a href="kelola_lembur.php">Kembali</a>
</body>
</html>

</body>
</html>
