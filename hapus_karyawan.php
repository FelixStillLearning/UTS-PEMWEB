<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID karyawan dari URL
$id_karyawan = $_GET['id'];

// Query untuk menghapus data karyawan
$query = "DELETE FROM karyawan WHERE id_karyawan='$id_karyawan'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_karyawan.php");
    exit();
} else {
    echo "Data gagal dihapus: " . mysqli_error($koneksi);
}
?>
