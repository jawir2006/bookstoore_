<?php
include '../config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM categories WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $conn->query("UPDATE categories SET name='$name' WHERE id=$id");
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Kategori</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="categories.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Edit Kategori Buku</h1>
        <form method="POST">
            <div class="form-group">
                <label>Nama Kategori:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>