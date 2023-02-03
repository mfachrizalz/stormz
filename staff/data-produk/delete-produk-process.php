<?php 
include("../../functions/connection.php");
$id_barang = $_GET['delete'];

$data = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_barang = '$id_barang'");
$result = mysqli_fetch_assoc($data);
$location = "../../assets/img/barang/";

$delete_foto = unlink($location . $result['foto']);

if ($delete_foto) {
    $query = "DELETE FROM tb_barang WHERE id_barang = '$id_barang'";
    mysqli_query($conn, $query);
}
header("location: ./");
exit;
?>