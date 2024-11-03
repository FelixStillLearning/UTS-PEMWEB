<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

$id = $_GET['id'];
$query = "DELETE FROM absensi WHERE id_absensi = '$id'";
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_absensi.php");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
