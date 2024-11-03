<?php
session_start();
include('koneksi.php');

// Ambil ID dari URL
$id_jabatan = $_GET['id'];

// Query untuk menghapus data jabatan
$query = "DELETE FROM jabatan WHERE id_jabatan = '$id_jabatan'";

if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_jabatan.php");
} else {
    echo "Jabatan Gagal Dihapus!";
}
?>
