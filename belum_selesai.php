<?php
require_once "controller.php";
$catatanList = $catatan->getBelumSelesai(); 
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Catatan Belum Selesai</title>
    <style>
    * {
        font-family: Arial, sans-serif
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .link {
        text-decoration: none;
        color: purple;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <h2>Catatan Belum Selesai</h2>
    <a href="utama.php" class="link">Kembali Ke Menu Utama</a><br><br>
    <table border="1">
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Pengguna</th>
            <th>Kategori</th>

        </tr>
        <?php foreach ($catatanList as $catatan) { ?>
        <tr>
            <td><?php echo $catatan['tanggal']; ?></td>
            <td><?php echo $catatan['keterangan']; ?></td>
            <td><?php echo $catatan['nama_user']; ?></td>
            <td><?php echo $catatan['nama_category']; ?></td>

        </tr>
        <?php } ?>
    </table>
</body>

</html>