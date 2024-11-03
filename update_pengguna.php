<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil data dari form
$username = $_POST['username'];
$new_username = $_POST['username_new']; // Untuk mengubah username jika diperlukan
$password = $_POST['password']; // Jika password kosong, tidak diupdate
$level = $_POST['level'];
$status = $_POST['status'];

// Jika password baru diisi, maka hash dan update password
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE pengguna SET username='$new_username', password='$hashed_password', level='$level', status='$status' WHERE username='$username'";
} else {
    $query = "UPDATE pengguna SET username='$new_username', level='$level', status='$status' WHERE username='$username'";
}

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_pengguna.php");
    exit();
} else {
    echo "Data gagal diperbarui: " . mysqli_error($koneksi);
}
?>
