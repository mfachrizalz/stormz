<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";

session_start();

if (isset($_POST['add-supp'])) {
    $username = add_supplier();
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $role = "supplier";

    $name_foto = $_FILES['foto']['name'];
    $extension_foto = explode('.', $name_foto);
    $extension_foto = strtolower(end($extension_foto));
    $rand_foto = uniqid();
    $send_foto = $rand_foto . "." . $extension_foto;
    $location = $_FILES['foto']['tmp_name'];
    $file_location = "../../assets/img/user-foto/supplier/";
    $upload_foto = move_uploaded_file($location, $file_location . $send_foto);

    if ($upload_foto) {
        $query = "INSERT INTO tb_user(username, password, nama_lengkap, perusahaan, email, telepon, foto, role)
                VALUES ('$username', '$password', '$fullname', '$company', '$email', '$telepon', '$send_foto', '$role')
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