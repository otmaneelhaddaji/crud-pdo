<?php
require_once "db.php";
require_once "User.php";

// Buat object user
$user = new User($db);
// Jika belum login
if ($user->isLoggedIn()) {
    echo !$user->isLoggedIn() ? "true" : "false";
    // header("location: login.php"); //Redirect ke halaman login
}
// Ambil data user saat ini
$currentUser = $user->getUser();

//===============

// Buat prepared statement untuk mengambil semua data dari Biodata
$query = $db->prepare("SELECT * FROM Biodata");
// Jalankan perintah SQL
$query->execute();
// Ambil semua data dan masukkan ke variable $data
$data = $query->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV LIST</title>
</head>

<body>
    <h3>Good morning <font color="red"><?php echo $currentUser['name'] ?></font>, <a href="logout.php">Logout</a></h3>
    <h1>CV LIST</h1>
    <a href="index.php"><button type="button">Home</button></a>
    <a href="create.php"><button type="button">ADD DATA</button></a>
    <a href="search.php"><button type="button">Search Data</button></a>
    <hr />
    <table border="1">
        <tr>
            <th>
                No
            </th>
            <th>
                #ID
            </th>
            <th>
                name
            </th>
            <th>
                address
            </th>
            <th>
                No number
            </th>
            <th>
                Aksi
            </th>
        </tr>
        <?php $no = 1; ?>
        <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
        <?php foreach ($data as $value) : ?>
            <tr>
                <td>
                    <?php echo $no ?>
                </td>
                <td>
                    <?php echo $value['id'] ?>
                </td>
                <td>
                    <?php echo $value['name'] ?>
                </td>
                <td>
                    <?php echo $value['address'] ?>
                </td>
                <td>
                    <?php echo $value['number'] ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $value['id'] ?>"><button type="button">Edit</button></a>
                    <a href="delete.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Sure to delete data !'); "><button type="button">Delete</button></a>
                </td>
            </tr>
            <?php $no++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>