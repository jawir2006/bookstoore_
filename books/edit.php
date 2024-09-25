<?php
include '../config.php';

// Ambil ID buku dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data buku berdasarkan ID
$sql = "SELECT * FROM books WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    die("Buku tidak ditemukan.");
}

// Ambil data kategori dari database
$sql_categories = "SELECT id, name FROM categories";
$result_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="books.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Edit Buku</h2>
        <form action="proses.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="author">Penulis:</label>
                <input type="text" id="author" name="author" class="form-control" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Terbit:</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo htmlspecialchars($book['tanggal']); ?>" required>
            </div>
            <div class="form-group">
                <label for="publisher">Penerbit:</label>
                <input type="text" id="publisher" name="publisher" class="form-control" value="<?php echo htmlspecialchars($book['publisher']); ?>" required>
            </div>
            <div class="form-group">
                <label for="pages">Jumlah Halaman:</label>
                <input type="number" id="pages" name="pages" class="form-control" value="<?php echo htmlspecialchars($book['pages']); ?>" required>
            </div>
            <div class="form-group">
                <label for="categories_name">Jenis Buku:</label>
                <select id="categories_name" name="categories_name" class="form-control" required>
                    <option value="">-- Pilih Jenis Buku --</option>
                    <?php
                    if ($result_categories->num_rows > 0) {
                        while ($row = $result_categories->fetch_assoc()) {
                            $selected = $book['category_id'] == $row['id'] ? 'selected' : '';
                            echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Buku</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>