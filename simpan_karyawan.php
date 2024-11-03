<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil data dari form
$kode_karyawan = $_POST['kode_karyawan'];
$nama_karyawan = $_POST['nama_karyawan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tgl_lahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$tgl_masuk = $_POST['tgl_masuk'];
$id_departemen = $_POST['id_departemen'];
$id_jabatan = $_POST['id_jabatan'];
$gaji_pokok = $_POST['gaji_pokok'];
$status_karyawan = $_POST['status_karyawan'];
$status = $_POST['status'];

// Query untuk menyimpan data karyawan
$query = "INSERT INTO karyawan (kode_karyawan, nama_karyawan, jenis_kelamin, tgl_lahir, alamat, no_hp, email, tgl_masuk, id_departemen, id_jabatan, gaji_pokok, status_karyawan, status) 
          VALUES ('$kode_karyawan', '$nama_karyawan', '$jenis_kelamin', '$tgl_lahir', '$alamat', '$no_hp', '$email', '$tgl_masuk', '$id_departemen', '$id_jabatan', '$gaji_pokok', '$status_karyawan', '$status')";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_karyawan.php");
    exit();
} else {
    echo "Data gagal disimpan: " . mysqli_error($koneksi);
}
?>
