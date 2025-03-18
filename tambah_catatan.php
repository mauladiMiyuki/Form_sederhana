<?php
require_once "controller.php"; 

$users = $catatan->getUsers();
$categories = $catatan->getCategories();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Harian</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        width: 300px;
        margin: 20px;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input,
    select,
    button {
        width: 100%;
        padding: 5px;
        margin-top: 5px;
    }

    .back-link {
        text-decoration: none;
        color: purple;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="container">
        <a href="utama.php" class="back-link">Kembali ke Catatan Harian</a>

        <form action="tambah_catatan.php" method="POST">
            <label for="pengguna">Pengguna:</label>
            <select id="pengguna" name="pengguna" required>
                <?php foreach ($users as $user) { ?>
                <option value="<?php echo $user['user_id']; ?>">
                    <?php echo $user['nama_user']; ?>
                </option>
                <?php } ?>
            </select>

            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" required>
                <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['category_id']; ?>">
                    <?php echo $category['nama_category']; ?>
                </option>
                <?php } ?>
            </select>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="keterangan">Keterangan:</label>
            <input type="text" id="keterangan" name="keterangan" required>

            <button type="submit">Tambah</button>
        </form>
    </div>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $pengguna = $_POST['pengguna'];
    $kategori = $_POST['kategori']; 
    $status = 1;

   
    if (empty($tanggal) || empty($keterangan) || empty($pengguna) || empty($kategori)) {
        die("Semua field harus diisi!");
    }

   
    $hasil = $catatan->tambahCatatan($tanggal, $keterangan, $pengguna, $kategori, $status);

    if ($hasil) {
        header("Location: utama.php?success=1");
        exit();
    } else {
        header("Location: utama.php?error=1");
        exit();
    }
}
?>