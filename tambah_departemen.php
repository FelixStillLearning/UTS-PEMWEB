<?php
include 'koneksi.php'; // Pastikan Anda sudah menyertakan file koneksi

// Proses penambahan departemen
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_departemen = $_POST['nama_departemen'];

    // Query untuk menyimpan departemen baru ke dalam database
    $query = "INSERT INTO departemen (nama_departemen) VALUES ('$nama_departemen')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Departemen berhasil ditambahkan'); window.location.href='kelola_departemen.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tambah_departemen.css"> <!-- Ganti dengan nama file CSS Anda -->
    <title>Tambah Departemen</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Tambah Departemen</h1>
        <form method="POST" action="">
            <div>
                <label for="nama_departemen">Nama Departemen:</label>
                <input type="text" id="nama_departemen" name="nama_departemen" required>
            </div>
            <div>
                <button type="submit" class="button edit-btn">Simpan Departemen</button>
                <a href="kelola_departemen.php" class="button logout-btn">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
