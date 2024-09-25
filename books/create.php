<?php
include '../config.php';

// Ambil data kategori dari database
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="books.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Tambah Buku</h2>
        <form action="proses.php" method="POST">
            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author">Penulis:</label>
                <input type="text" id="author" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Terbit:</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="publisher">Penerbit:</label>
                <input type="text" id="publisher" name="publisher" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pages">Jumlah Halaman:</label>
                <input type="number" id="pages" name="pages" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="categories_name">Jenis Buku:</label>
                <select id="categories_name" name="categories_name" class="form-control" required>
                    <option value="">-- Pilih Jenis Buku --</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Buku</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>