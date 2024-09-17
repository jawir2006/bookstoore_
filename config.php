<?php
$host = 'localhost';  // atau '127.0.0.1'
$db = 'peminjambuku';
$user = 'root';  // sesuaikan dengan username MySQL kamu
$pass = '';      // masukkan password jika ada

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>