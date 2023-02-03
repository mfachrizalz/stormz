<?php 
require('../functions/connection.php');

$user_kode = "STAFF-1001";
$user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
$user_fullname = $_POST['user_fullname'];
$user_company = $_POST['user_company'];
$user_email = $_POST['user_email'];
$user_role = $_POST['role_select'];

if (isset($_POST['signup'])) {
    $query = "INSERT INTO tb_user(user_kode, user_password, user_fullname, user_company, user_email, user_role) VALUES
                ('$user_kode', '$user_password', '$user_fullname', '$user_company', '$user_email', '$user_role')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
            alert('Data telah berhasil ditambahkan');
            location.replace('../signin/');
        </script>
        ";
    } else {
        header("Location: ./index?error=1");
        exit;
    }
}
$_SESSION['signin'] = false;
?>