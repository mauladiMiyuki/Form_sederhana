<?php

$host = "localhost:3307"; 
$user = "root"; 
$password = ""; 
$database = "db_catatan";


$koneksi = mysqli_connect($host, $user, $password, $database);


if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
} 

?>