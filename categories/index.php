<?php
include '../config.php';

$result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Kategori Buku</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="categories.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Kategori Buku</h1>
        <div class="mb-3">
            <a href="create.php" class="btn btn-primary">Tambah Kategori</a>
            <a href="../books/index.php" class="btn btn-secondary">Lihat Buku</a>
            <a href="../index.php" class="btn btn-info">Kembali ke Beranda</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
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