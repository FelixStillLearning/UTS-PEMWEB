<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID lembur dari URL
$id_lembur = $_GET['id'];

// Query untuk menghapus data lembur
$query = "DELETE FROM lembur WHERE id_lembur='$id_lembur'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_lembur.php");
    exit();
} else {
    echo "Data gagal dihapus: " . mysqli_error($koneksi);
}
?>
