<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";

if (isset($_POST['add-user'])) {
    $username = add_supplier();
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $role = "supplier";

    $foto = $_FILES['foto']['name'];
    $location = $_FILES['foto']['tmp_name'];
    $file_location = "../../assets/img/user-foto/supplier/";
    $upload_foto = move_uploaded_file($location, $file_location . $foto);

    if ($upload_foto) {
        $query = "INSERT INTO tb_user(username, password, nama_lengkap, perusahaan, email, telepon, foto, role)
                VALUES ('$username', '$password', '$fullname', '$company', '$email', '$telepon', '$foto', '$role')
                ";
        $result = mysqli_query($conn, $query);
    }

    if (!$upload_foto || !$result) {
        $_SESSION['add-user-status'] = 2;
    }
    $_SESSION['add-user-status'] = 1;

    header("location: ./");
    exit;
}
?>