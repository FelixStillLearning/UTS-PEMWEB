<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID jabatan dari URL
$id_jabatan = $_GET['id'];

// Ambil data jabatan berdasarkan ID
$query = "SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'";
$result = mysqli_query($koneksi, $query);
$jabatan = mysqli_fetch_assoc($result);

// Jika data jabatan tidak ditemukan
if (!$jabatan) {
    echo "Data jabatan tidak ditemukan!";
    exit();
}

// Proses ketika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_jabatan = $_POST['nama_jabatan'];

    // Update data jabatan
    $query_update = "UPDATE jabatan SET nama_jabatan = '$nama_jabatan' WHERE id_jabatan = '$id_jabatan'";
    if (mysqli_query($koneksi, $query_update)) {
        header("Location: kelola_jabatan.php");
        exit();
    } else {
        echo "Gagal mengupdate jabatan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Jabatan</title>
    <link href="kelola_jabatan.css" rel="stylesheet"> <!-- Menghubungkan file CSS -->
</head>
<body>
    <div class="form-container">
        <h1>Ubah Jabatan</h1>
        <form method="POST">
            <label>Nama Jabatan:</label>
            <input type="text" name="nama_jabatan" value="<?php echo htmlspecialchars($jabatan['nama_jabatan']); ?>" required><br>
            <button type="submit">Update</button>
        </form>
        <br>
        <a href="kelola_jabatan.php" class="button back-btn">Kembali ke Kelola Jabatan</a>
    </div>
</body>
</html>
