<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['edit-kategori'])) {
    $id_kategori = $_POST['id-kategori'];
    $kategori = strtolower($_POST['kategori']);    

    $query = "UPDATE tb_kategori SET kategori = '$kategori' WHERE id_kategori = '$id_kategori'";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['edit-kategori-status'] = 1;
    } else {
        $_SESSION['edit-kategori-status'] = 2;
    }
    
    header("location: ./index.php?edit=" . $id_kategori);
    exit;
}
?>