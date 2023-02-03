<?php 
include("../../functions/connection.php");
$username = $_GET['delete'];

$data = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result = mysqli_fetch_assoc($data);

if ($result['role'] == "staff") {
    $location = "../../assets/img/user-foto/staff/";
} else if ($result['role'] == "supplier") {
    $location = "../../assets/img/user-foto/supplier/";
} else if ($result['role'] == "manager") {
    $location = "../../assets/img/user-foto/manager/";
}

$delete_foto = unlink($location . $result['foto']);

if ($delete_foto) {
    $query = "DELETE FROM tb_user WHERE username = '$username'";
    mysqli_query($conn, $query);
}
header("location: ./");
exit;
?>