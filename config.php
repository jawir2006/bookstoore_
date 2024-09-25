<?php
$host = '127.0.0.1';  // atau 'localhost'
$db = 'peminjambuku';
$user = 'root';  // sesuaikan dengan username MySQL kamu
$pass = '';      // masukkan password jika ada

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
// if ($conn->connect_error) {
//    die("Koneksi gagal: " . $conn->connect_error);
//} else {
//    echo "Koneksi berhasil";
//}
?>