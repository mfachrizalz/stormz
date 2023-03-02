<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['edit-pw'])) {
    $username = $_SESSION['username'];
    $pw_old = $_POST['pw-old'];
    $pw_new = $_POST['pw-new'];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($result);
    $password_hash = $result['password'];

    if (password_verify($pw_old, $password_hash)) {
        $_SESSION['edit-pw-status'] = 1;
        $password_hash_new = password_hash($pw_new, PASSWORD_DEFAULT);
        $result = mysqli_query($conn, "UPDATE tb_user SET password = '$password_hash_new' WHERE username = '$username'");
    } else {
        $_SESSION['edit-pw-status'] = 2;
    }
}
header("location: ../edit-password");
?>