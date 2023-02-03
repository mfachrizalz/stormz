<?php 
include("../../functions/connection.php");
$id_kategori = $_GET['delete'];

$query = "DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori'";
mysqli_query($conn, $query);
header("location: ./");
exit;
?>