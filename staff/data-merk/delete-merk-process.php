<?php 
include("../../functions/connection.php");
$id_merk = $_GET['delete'];

$query = "DELETE FROM tb_merk WHERE id_merk = '$id_merk'";
mysqli_query($conn, $query);
header("location: ./");
exit;
?>