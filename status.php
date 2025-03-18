<?php
require_once "controller.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = isset($_POST['status']) ? 'selesai' : 'belum';

    if ($catatan->Status($id, $status)) {
        header("Location: utama.php");
        exit();
    } else {
        die("Eror wa coba pang perbaiki");
    }
}

?>