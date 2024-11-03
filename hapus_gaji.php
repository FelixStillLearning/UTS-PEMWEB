<?php
session_start();
include('koneksi.php');

// Ambil ID dari URL
$id_gaji = $_GET['id'];

// Query untuk menghapus data gaji
$query = "DELETE FROM gaji WHERE id_gaji = '$id_gaji'";

if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_gaji.php");
} else {
    echo "Gaji Gagal Dihapus!";
}
?>
