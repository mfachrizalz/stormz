<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";

session_start();

if (isset($_POST['edit-user'])) {
    $username = strtolower($_POST['username']);
    $fullname = $_POST['fullname'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $arr_cek_role = explode('-', $username);
    $cek_role = strtolower($arr_cek_role[0]);
    if ($cek_role == "staff") {
        $file_location = "../../assets/img/user-foto/staff/";
    } else if ($cek_role == "supp") {
        $file_location = "../../assets/img/user-foto/supplier/";
    } else if ($cek_role == "mgr") {
        $file_location = "../../assets/img/user-foto/manager/";
    }

    $name_foto = $_FILES['foto']['name'];
    $extension_foto = explode('.', $name_foto);
    $extension_foto = strtolower(end($extension_foto));
    $rand_foto = uniqid();
    $location = $_FILES['foto']['tmp_name'];

    if ($_FILES['foto']['error'] == 4) {
        $send_foto = $_POST['foto-old'];
        $query = "UPDATE tb_user 
                SET nama_lengkap = '$fullname', perusahaan = '$company', email = '$email', telepon = '$telepon', foto = '$send_foto'
                WHERE username = '$username'
                ";
        $result = mysqli_query($conn, $query);
    } else {
        $send_foto = $rand_foto . "." . $extension_foto;
        $upload_foto = move_uploaded_file($location, $file_location . $send_foto);

        if ($upload_foto) {
            unlink($file_location . $_POST['foto-old']);
            $query = "UPDATE tb_user 
                    SET nama_lengkap = '$fullname', perusahaan = '$company', email = '$email', telepon = '$telepon', foto = '$send_foto'
                    WHERE username = '$username'
                    ";
            $result = mysqli_query($conn, $query);
        }
    }

    if (!$upload_foto || !$result) {
        $_SESSION['edit-user-status'] = 2;
    }
    $_SESSION['edit-user-status'] = 1;

    header("location: ./index.php?edit=$username");
    exit;
}
?>