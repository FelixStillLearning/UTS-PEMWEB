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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ubah_lembur.css"> <!-- Link to the CSS file -->
    <title>Ubah Lembur</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Ubah Lembur</h1>
        <form action="update_lembur.php" method="POST">
            <input type="hidden" name="id_lembur" value="<?php echo htmlspecialchars($row['id_lembur']); ?>">
            
            <div class="form-group">
                <label for="id_karyawan">ID Karyawan:</label>
                <input type="text" name="id_karyawan" value="<?php echo htmlspecialchars($row['id_karyawan']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="tanggal">Tanggal Lembur:</label>
                <input type="date" name="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai:</label>
                <input type="time" name="jam_mulai" value="<?php echo htmlspecialchars($row['jam_mulai']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai:</label>
                <input type="time" name="jam_selesai" value="<?php echo htmlspecialchars($row['jam_selesai']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="tarif_perjam">Tarif per Jam:</label>
                <input type="number" name="tarif_perjam" value="<?php echo htmlspecialchars($row['tarif_perjam']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea name="keterangan"><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" class="button edit-btn" value="Update">
            </div>
        </form>
        <a class="button back-btn" href="kelola_lembur.php">Kembali</a>
    </div>
</body>
</html>
