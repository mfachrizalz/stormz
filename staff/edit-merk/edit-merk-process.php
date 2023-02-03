<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['edit-merk'])) {
    $id_merk = $_POST['id-merk'];
    $merk = strtolower($_POST['merk']);

    $query = "UPDATE tb_merk SET merk = '$merk' WHERE id_merk = '$id_merk'";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['edit-merk-status'] = 1;
    } else {
        $_SESSION['edit-merk-status'] = 2;
    }
    
    header("location: ./index.php?edit=" . $id_merk);
    exit;
}
?>