<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_absensi = $_POST['id_absensi'];
    $id_karyawan = $_POST['id_karyawan'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $tanggal = $_POST['tanggal'];
    $status_kehadiran = $_POST['status_kehadiran'];

    $query = "UPDATE absensi SET id_karyawan='$id_karyawan', nama_karyawan='$nama_karyawan', tanggal='$tanggal', status_kehadiran='$status_kehadiran' WHERE id_absensi='$id_absensi'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: kelola_absensi.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
