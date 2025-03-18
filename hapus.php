<?php
require 'controller.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $catatan = new Catatan($koneksi);
    if ($catatan->hapusCatatan($id)) {
        echo "<script>alert('Data berhasil dihapus'); window.location='utama.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>