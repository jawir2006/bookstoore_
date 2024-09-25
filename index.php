<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Buku</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<a href="logout.php" class="btn btn-danger mx-2">Logout</a>

<body>
    <div class="container text-center mt-5">
        <h1 class="mb-4">Selamat Datang di Bookstore</h1>
        <div class="d-flex justify-content-center">
            <a href="books/index.php" class="btn btn-primary mx-2">Lihat Daftar Buku</a>
            <a href="categories/index.php" class="btn btn-secondary mx-2">Lihat Daftar Kategori</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>