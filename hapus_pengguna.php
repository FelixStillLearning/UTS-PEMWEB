<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID pengguna dari URL
$id_pengguna = $_GET['id'];

// Query untuk menghapus data pengguna
$query = "DELETE FROM pengguna WHERE id_pengguna='$id_pengguna'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_pengguna.php");
    exit();
} else {
    echo "Data gagal dihapus: " . mysqli_error($koneksi);
}
?>
