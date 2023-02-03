<?php 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_stormz";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    echo "Gagal Koneksi ke Database: " . mysqli_connect_error();
}
?>