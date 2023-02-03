<?php 
require('./functions/connection.php');

session_start();
$username = $_SESSION['username'];
mysqli_query($conn, "DELETE FROM tb_transaksi_detail_temp WHERE username = '$username'");
session_destroy();

header("Location: ./signin/");
exit;
?>