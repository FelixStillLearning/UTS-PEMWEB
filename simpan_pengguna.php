<?php
session_start();

include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $status = $_POST['status'];

    list($kode_karyawan, $id_karyawan) = explode(',', $_POST['kode_id_karyawan']);
    
    
    

    // Hash password sebelum menyimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Periksa apakah kode karyawan valid
    $query_check = "SELECT * FROM karyawan WHERE kode_karyawan = '$kode_karyawan'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Kode karyawan valid, lanjutkan menyimpan pengguna baru
        $query_insert = "INSERT INTO pengguna (username, password, id_karyawan, level, status) 
                         VALUES ('$username', '$hashed_password', '$id_karyawan', '$level', '$status')";

        if (mysqli_query($koneksi, $query_insert)) {
            header("Location: kelola_pengguna.php");
            exit();
        } else {
            echo "Gagal menambahkan pengguna: " . mysqli_error($koneksi);
        }
    } else {
        echo "Kode karyawan tidak valid.";
    }
}
?>
