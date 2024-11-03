<?php
session_start();
include('koneksi.php');

// Ambil data dari form dan sanitasi input
$id_karyawan = $_POST['id_karyawan'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$gaji_pokok = $_POST['gaji_pokok'];
$tunjangan_jabatan = $_POST['tunjangan_jabatan'];
$tunjangan_makan = $_POST['tunjangan_makan'];
$tunjangan_transport = $_POST['tunjangan_transport'];
$potongan = $_POST['potongan'];

// Hitung total gaji
$total_gaji = $gaji_pokok + $tunjangan_jabatan + $tunjangan_makan + $tunjangan_transport - $potongan;

// Query untuk menyimpan data gaji
$query = "INSERT INTO gaji (id_karyawan, bulan, tahun, gaji_pokok, tunjangan_jabatan, tunjangan_makan, tunjangan_transport, potongan, total_gaji, total_lembur, status_bayar) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Persiapkan statement
$stmt = mysqli_prepare($koneksi, $query);
$total_lembur = 0; // Anda bisa menambahkan nilai lembur di sini jika diperlukan
$status_bayar = 'Draft'; // Status awal

// Bind parameters
mysqli_stmt_bind_param($stmt, 'iiiiiisssis', $id_karyawan, $bulan, $tahun, $gaji_pokok, $tunjangan_jabatan, $tunjangan_makan, $tunjangan_transport, $potongan, $total_gaji, $total_lembur, $status_bayar);

// Eksekusi statement
if (mysqli_stmt_execute($stmt)) {
    header("Location: kelola_gaji.php");
    exit();
} else {
    echo "Gaji Gagal Disimpan: " . mysqli_error($koneksi);
}

// Tutup statement
mysqli_stmt_close($stmt);
?>
