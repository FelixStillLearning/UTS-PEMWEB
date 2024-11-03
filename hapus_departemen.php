<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil ID departemen dari URL
$id_departemen = $_GET['id'];

// Hapus data departemen
$query = "DELETE FROM departemen WHERE id_departemen = '$id_departemen'";
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_departemen.php");
    exit();
} else {
    echo "Gagal menghapus departemen!";
}
?>
