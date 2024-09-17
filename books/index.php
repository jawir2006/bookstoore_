<?php
include '../config.php';

// Ambil data buku dari database
$selectedCategory = isset($_POST['category']) ? $_POST['category'] : '';
$searchText = isset($_POST['search']) ? $_POST['search'] : '';
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

$query = "SELECT books.*, categories.name as category_name FROM books 
          LEFT JOIN categories ON books.category_id = categories.id 
          WHERE 1=1";

if ($selectedCategory) {
    $query .= " AND category_id = " . intval($selectedCategory);
}

if ($searchText) {
    $query .= " AND (title LIKE '%" . $conn->real_escape_string($searchText) . "%' OR author LIKE '%" . $conn->real_escape_string($searchText) . "%')";
}

if ($startDate) {
    $query .= " AND tanggal >= '" . $conn->real_escape_string($startDate) . "'";
}

if ($endDate) {
    $query .= " AND tanggal <= '" . $conn->real_escape_string($endDate) . "'";
}

$result = $conn->query($query);
$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Buku</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="books.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Daftar Buku</h1>
        <div class="mb-3">
            <a href="create.php" class="btn btn-primary">Tambah Buku</a>
            <a href="../categories/index.php" class="btn btn-secondary">Lihat Kategori</a>
            <a href="../index.php" class="btn btn-info">Kembali ke Beranda</a>
        </div>
        <form method="POST" class="filter-form mb-4">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Kategori:</label>
                    <select name="category" class="form-control">
                        <option value="">Semua Kategori</option>
                        <?php while ($cat = $categories->fetch_assoc()) { ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo $selectedCategory == $cat['id'] ? 'selected' : ''; ?>>
                                <?php echo $cat['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Cari:</label>
                    <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($searchText); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>Tanggal Penerbitan (dari):</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($startDate); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>Tanggal Penerbitan (sampai):</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($endDate); ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal Terbit</th>
                        <th>Penerbit</th>
                        <th>Jumlah Halaman</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['author']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td><?php echo htmlspecialchars($row['publisher']); ?></td>
                            <td><?php echo htmlspecialchars($row['pages']); ?></td>
                            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm action-btn">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>