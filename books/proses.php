<?php
// Pure function to handle SQL connection
function createConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "peminjambuku";
    return new mysqli($servername, $username, $password, $dbname);
}

// Pure function to sanitize input and prevent SQL injection
function sanitizeInput($conn, $input)
{
    return isset($input) && !empty($input) ? $conn->real_escape_string($input) : null;
}

// Pure function to insert data into the database
function insertBook($conn, $title, $author, $tanggal, $publisher, $pages, $category_id)
{
    $sql = "INSERT INTO books (title, author, tanggal, publisher, pages, category_id) 
            VALUES ('$title', '$author', '$tanggal', '$publisher', '$pages', '$category_id')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Pure function to update data in the database
function updateBook($conn, $id, $title, $author, $tanggal, $publisher, $pages, $category_id)
{
    $sql = "UPDATE books SET title='$title', author='$author', tanggal='$tanggal', publisher='$publisher', pages='$pages', category_id='$category_id' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Main logic
$conn = createConnection();

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil dan sanitasi data dari form
$title = sanitizeInput($conn, $_POST['title']);
$author = sanitizeInput($conn, $_POST['author']);
$tanggal = isset($_POST['tanggal']) ? sanitizeInput($conn, $_POST['tanggal']) : null; // Tanggal Terbit
$publisher = sanitizeInput($conn, $_POST['publisher']);
$pages = sanitizeInput($conn, $_POST['pages']);
$category_id = sanitizeInput($conn, $_POST['categories_name']);

// Validasi input
if (empty($title) || empty($author) || empty($publisher) || empty($pages) || empty($category_id)) {
    die("Semua field harus diisi.");
}

// Default date handling
if (empty($tanggal)) {
    $tanggal = date('Y-m-d');
}

// Validasi category_id
$category_id = intval($category_id);
$category_check = $conn->query("SELECT id FROM categories WHERE id = $category_id");
if ($category_check->num_rows == 0) {
    die("Kategori tidak valid.");
}

// Tentukan apakah ini operasi tambah atau edit
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    // Operasi edit
    $result = updateBook($conn, $id, $title, $author, $tanggal, $publisher, $pages, $category_id);
} else {
    // Operasi tambah
    $result = insertBook($conn, $title, $author, $tanggal, $publisher, $pages, $category_id);
}

$conn->close();

if ($result === true) {
    echo "<script>
        alert('Buku berhasil " . ($id > 0 ? "diperbarui" : "ditambahkan") . "!');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . $result . "');
        window.history.back();
    </script>";
}
?>