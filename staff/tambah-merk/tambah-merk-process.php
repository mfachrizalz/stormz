<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['add-merk'])) {
    $merk = strtolower($_POST['merk']);

    $query = "INSERT INTO tb_merk(id_merk, merk) VALUES ('', '$merk')";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['add-merk-status'] = 1;
    } else {
        $_SESSION['add-merk-status'] = 2;
    }
    
    header("location: ./");
    exit;
}
?>