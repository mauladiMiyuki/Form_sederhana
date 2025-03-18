<?php
require_once "controller.php";
$catatanList = $catatan->getAllCatatan();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan</title>
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
    <h2>Daftar Catatan</h2>
    <a href="belum_selesai.php" class="link">Belum Selesai</a> |
    <a href="sudah_selesai.php" class="link">Sudah Selesai</a><br><br>
    <a href="tambah_catatan.php" class="link">Tambah Catatan</a>
    <br><br>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Pengguna</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($catatanList as $catatan) { ?>
        <tr>
            <td><?php echo $catatan['tanggal']; ?></td>
            <td><?php echo $catatan['keterangan']; ?></td>
            <td><?php echo $catatan['nama_user']; ?></td>
            <td><?php echo $catatan['nama_category']; ?></td>
            <td>
                <form method="POST" action="status.php">
                    <input type="hidden" name="id" value="<?php echo $catatan['id']; ?>">
                    <input type="checkbox" name="status" value="selesai"
                        <?php echo ($catatan['status'] == 'selesai') ? 'checked' : ''; ?>
                        onchange="this.form.submit();">
                </form>
            </td>


            <td>
                <a href="edit.php?id=<?php echo $catatan['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $catatan['id']; ?>"
                    onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>

</html>