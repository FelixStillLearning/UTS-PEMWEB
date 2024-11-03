<?php
session_start();
include('koneksi.php');

// Ambil data dari form
$id_gaji = $_POST['id_gaji'];
$id_karyawan = $_POST['id_karyawan'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$gaji_pokok = $_POST['gaji_pokok'];
$tunjangan_jabatan = $_POST['tunjangan_jabatan'];
$tunjangan_makan = $_POST['tunjangan_makan'];
$tunjangan_transport = $_POST['tunjangan_transport'];
$potongan = $_POST['potongan'];
$total_lembur = 0; // Jika ada nilai untuk total lembur, ambil dari input form
$total_gaji = $gaji_pokok + $tunjangan_jabatan + $tunjangan_makan + $tunjangan_transport - $potongan;

// Ambil tanggal bayar dan status bayar dari input
$tanggal_bayar = $_POST['tanggal_bayar']; // Pastikan input ini ada dalam form
$status_bayar = $_POST['status_bayar']; // Pastikan input ini ada dalam form

// Query untuk memperbarui data gaji
$query = "UPDATE gaji SET 
            id_karyawan = '$id_karyawan', 
            bulan = '$bulan', 
            tahun = '$tahun', 
            gaji_pokok = '$gaji_pokok', 
            tunjangan_jabatan = '$tunjangan_jabatan',
            tunjangan_makan = '$tunjangan_makan',
            tunjangan_transport = '$tunjangan_transport',
            total_lembur = '$total_lembur', 
            potongan = '$potongan', 
            total_gaji = '$total_gaji',
            tanggal_bayar = '$tanggal_bayar',
            status_bayar = '$status_bayar' 
          WHERE id_gaji = '$id_gaji'";

if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_gaji.php");
    exit(); // Menyelesaikan eksekusi setelah header
} else {
    echo "Gaji Gagal Diperbarui: " . mysqli_error($koneksi); // Menampilkan error jika gagal
}
?>
