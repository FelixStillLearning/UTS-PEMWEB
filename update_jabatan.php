<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'Admin') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Cek apakah data POST diterima
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jabatan = $_POST['id_jabatan'];
    $nama_jabatan = $_POST['nama_jabatan'];

    // Update jabatan
    $query = "UPDATE jabatan SET nama_jabatan = '$nama_jabatan' WHERE id_jabatan = '$id_jabatan'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: kelola_jabatan.php?message=update_success");
    } else {
        die("Error updating record: " . mysqli_error($koneksi));
    }
}
?>
