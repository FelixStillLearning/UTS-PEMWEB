<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID departemen dari URL
$id_departemen = $_GET['id'];

// Ambil data departemen berdasarkan ID
$query = "SELECT * FROM departemen WHERE id_departemen = '$id_departemen'";
$result = mysqli_query($koneksi, $query);
$departemen = mysqli_fetch_assoc($result);

// Jika data departemen tidak ditemukan
if (!$departemen) {
    echo "Data departemen tidak ditemukan!";
    exit();
}

// Proses ketika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_departemen = $_POST['nama_departemen'];

    // Update data departemen
    $query_update = "UPDATE departemen SET nama_departemen = '$nama_departemen' WHERE id_departemen = '$id_departemen'";
    if (mysqli_query($koneksi, $query_update)) {
        header("Location: kelola_departemen.php");
        exit();
    } else {
        echo "Gagal mengupdate departemen!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Departemen</title>
    <!-- Tambahkan link ke file CSS -->
    <link rel="stylesheet" href="ubah_departemen.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Ubah Departemen</h1>
        <form method="POST">
            <label>Nama Departemen:</label>
            <input type="text" name="nama_departemen" value="<?php echo $departemen['nama_departemen']; ?>" required>
            <input type="submit" class="btn" value="Update">
        </form>
        <br>
        <a href="kelola_departemen.php" class="back-btn">Kembali ke Kelola Departemen</a>
    </div>
</body>
</html>
