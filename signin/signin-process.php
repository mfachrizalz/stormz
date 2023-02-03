<?php 
require('../functions/connection.php');

session_start();

$username = $_POST['username'];
$user_password = $_POST['password'];

if (isset($_POST['signin'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);
    if (mysqli_num_rows($query) == 1) {
        $password_hash = $result['password'];
        if (password_verify($user_password, $password_hash)) {
            $_SESSION['signin'] = true;
            $_SESSION['username'] = $result['username'];
            $_SESSION['user_role'] = $result['role'];
            // $_SESSION['user_fullname'] = $result['nama_lengkap'];
            // $_SESSION['user_company'] = $result['perusahaan'];
            // $_SESSION['user_email'] = $result['email'];

            $user_role = $result['role'];
            switch ($user_role) {
                case 'staff':
                    $_SESSION['signin-error'] = 1;
                    header("Location: ../staff/");
                    exit;

                case 'supplier':
                    $_SESSION['signin-error'] = 1;
                    header("Location: ../supplier/");
                    exit;
                
                case 'manager':
                    $_SESSION['signin-error'] = 1;
                    header("Location: ../manager/");
                    exit;
            }
        } else {
            $_SESSION['signin-error'] = 2;
            header("Location: ./");
            exit;
        }
    } else {
        $_SESSION['signin-error'] = 2;
        header("Location: ./");
        exit;
    }
}
?>