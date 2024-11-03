<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil data dari form
$id_karyawan = $_POST['id_karyawan'];
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

// Query untuk memperbarui data karyawan
$query = "UPDATE karyawan 
          SET nama_karyawan='$nama_karyawan', 
              jenis_kelamin='$jenis_kelamin', 
              tgl_lahir='$tgl_lahir', 
              alamat='$alamat', 
              no_hp='$no_hp', 
              email='$email', 
              tgl_masuk='$tgl_masuk', 
              id_departemen='$id_departemen', 
              id_jabatan='$id_jabatan', 
              gaji_pokok='$gaji_pokok', 
              status_karyawan='$status_karyawan', 
              status='$status' 
          WHERE id_karyawan='$id_karyawan'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_karyawan.php");
    exit();
} else {
    echo "Data gagal diperbarui: " . mysqli_error($koneksi);
}
?>
