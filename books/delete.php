<?php
include '../config.php';

// Ambil ID buku dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Hapus data buku berdasarkan ID
$sql = "DELETE FROM books WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Buku berhasil dihapus!');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . $conn->error . "');
        window.history.back();
    </script>";
}
?>