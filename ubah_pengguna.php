<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil username pengguna dari URL
$username = $_GET['id'];

// Query untuk mengambil data pengguna berdasarkan username
$query = "SELECT * FROM pengguna WHERE username='$username'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="ubah_pengguna.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <h1>Edit Pengguna</h1>
        <form action="update_pengguna.php" method="POST">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">
            
            <label for="username_new">Username:</label>
            <input type="text" id="username_new" name="username_new" value="<?php echo htmlspecialchars($row['username']); ?>" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password baru (jika ingin mengubah)">
            
            <label for="level">Level:</label>
            <select id="level" name="level" required>
                <option value="Admin" <?php echo ($row['level'] === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="HRD" <?php echo ($row['level'] === 'HRD') ? 'selected' : ''; ?>>HRD</option>
                <option value="Karyawan" <?php echo ($row['level'] === 'Karyawan') ? 'selected' : ''; ?>>Karyawan</option>
            </select>
            
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Aktif" <?php echo ($row['status'] === 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="Tidak Aktif" <?php echo ($row['status'] === 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>
            
            <input type="submit" class="btn update-btn" value="Update">
        </form>
        <a href="kelola_pengguna.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</body>
</html>
