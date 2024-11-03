<?php
// Include koneksi database
include('koneksi.php');

// Get data dari form
$id_departemen = $_POST['id_departemen']; // Pastikan form yang mengarah ke sini memiliki input ini
$nama_departemen = $_POST['nama_departemen'];

// Query update data ke dalam database berdasarkan ID
$query = "UPDATE departemen SET nama_departemen = '$nama_departemen' WHERE id_departemen = '$id_departemen'";

// Kondisi pengecekan apakah data berhasil diupdate atau tidak
if ($koneksi->query($query)) {
    // Redirect ke halaman kelola_departemen.php
    header("location: kelola_departemen.php");
} else {
    // Pesan error gagal update data
    echo "Data Gagal Diupdate: " . $koneksi->error;
}
?>
