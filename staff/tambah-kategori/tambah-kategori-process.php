<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['add-kategori'])) {
    $kategori = strtolower($_POST['kategori']);

    $query = "INSERT INTO tb_kategori(id_kategori, kategori) VALUES ('', '$kategori')";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['add-kategori-status'] = 1;
    } else {
        $_SESSION['add-kategori-status'] = 2;
    }
    
    header("location: ./");
    exit;
}
?>