<?php
session_start();
include('koneksi.php'); // Pastikan Anda menyertakan file koneksi

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa apakah username valid di tabel pengguna
$query = "SELECT * FROM pengguna WHERE username='$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Cek apakah password di-hash atau tidak
    if (password_verify($password, $user['password'])) {
        // Jika password cocok dengan hash
        $login_berhasil = true;
    } elseif ($user['password'] === $password) {
            // Hash password dan update di database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_query = "UPDATE pengguna SET password='$hashed_password' WHERE username='$username'";
            mysqli_query($koneksi, $update_query);
        // Jika password adalah plain text dan cocok
        $login_berhasil = true;
    } else {
        $login_berhasil = false;
    }

    if ($login_berhasil) {
        // Set session
        $_SESSION['id_karyawan'] = $user['id_karyawan'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level'];

        // Redirect berdasarkan level pengguna
        if ($user['level'] === 'Admin') {
            header("Location: dashboard_admin.php");
        } elseif ($user['level'] === 'HRD') {
            header("Location: dashboard_hrd.php");
        } elseif ($user['level'] === 'Karyawan') {
            header("Location: dashboard_karyawan.php");
        }
        exit();
    } else {
        // Jika password salah, set pesan error dan redirect kembali ke form login
        $_SESSION['error'] = "Password salah!";
        header("Location: formlogin.php");
        exit();
    }
} else {
    // Jika username tidak ditemukan, set pesan error dan redirect kembali ke form login
    $_SESSION['error'] = "Username tidak ditemukan!";
    header("Location: formlogin.php");
    exit();
}
?>
