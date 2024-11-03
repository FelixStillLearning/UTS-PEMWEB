<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'HRD') {
    header("Location: formlogin.php");
    exit();
}

include('koneksi.php');

// Ambil data dari form
$id_lembur = $_POST['id_lembur'];
$id_karyawan = $_POST['id_karyawan'];
$tanggal = $_POST['tanggal_lembur']; // Ubah sesuai dengan nama field pada form
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tarif_perjam = $_POST['tarif_perjam'];
$keterangan = $_POST['keterangan']; // Jika ada kolom keterangan

// Menghitung total jam lembur
$datetime1 = new DateTime($jam_mulai);
$datetime2 = new DateTime($jam_selesai);
$interval = $datetime1->diff($datetime2);
$total_jam = $interval->h + ($interval->i / 60);

// Menghitung total lembur
$total_lembur = $total_jam * $tarif_perjam;

// Query untuk memperbarui data lembur
$query = "UPDATE lembur 
          SET id_karyawan='$id_karyawan', 
              tanggal='$tanggal', 
              jam_mulai='$jam_mulai', 
              jam_selesai='$jam_selesai', 
              total_jam='$total_jam', 
              tarif_perjam='$tarif_perjam', 
              total_lembur='$total_lembur', 
              keterangan='$keterangan' 
          WHERE id_lembur='$id_lembur'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: kelola_lembur.php");
    exit();
} else {
    echo "Data gagal diperbarui: " . mysqli_error($koneksi);
}
?>
