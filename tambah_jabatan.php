<?php
include 'koneksi.php'; // Pastikan Anda sudah menyertakan file koneksi

// Proses penambahan jabatan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_jabatan = $_POST['nama_jabatan'];

    // Query untuk menyimpan jabatan baru ke dalam database
    $query = "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama_jabatan')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jabatan berhasil ditambahkan'); window.location.href='kelola_jabatan.php';</script>";
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
    <link rel="stylesheet" href="tambah_jabatan.css"> <!-- Ganti dengan nama file CSS Anda -->
    <title>Tambah Jabatan</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Tambah Jabatan</h1>
        <form method="POST" action="">
            <div>
                <label for="nama_jabatan">Nama Jabatan:</label>
                <input type="text" id="nama_jabatan" name="nama_jabatan" required>
            </div>
            <div>
                <button type="submit" class="button edit-btn">Simpan Jabatan</button>
                <a href="kelola_jabatan.php" class="button logout-btn">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
