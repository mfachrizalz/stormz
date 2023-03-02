<?php 
require('./functions/connection.php');
include "./functions/functions.php";

$pw = password_hash("staff123", PASSWORD_DEFAULT);
echo $pw;
exit;
?>
<script src="./js/sweet-alert.js"></script>
<script type="text/javascript">
        status_tambah_user(2);
</script>
<?php    
exit;
@$username = "staff-1001";
@$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
@$fullname = $_POST['fullname'];
@$company = $_POST['company'];
@$email = $_POST['email'];
@$telepon = $_POST['telepon'];
$foto = "foto2.jpg";
$role = "supplier";

if (isset($_POST['signin'])) {
    $query = "INSERT INTO tb_user (username, password, nama_lengkap, perusahaan, email, telepon, foto, role) 
                VALUES ('$username', '$password', '$fullname', '$company', '$email', '$telepon', '$foto', '$role')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo mysqli_error($conn);
    }
} else if (isset($_POST['submitCompany'])) {
    $query = "INSERT INTO tb_supplier (supplier_id, supplier_username, supplier_password, supplier_company) VALUES ('', '$username', '$password', '$company')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo mysqli_error($conn);
    }

echo $username;
echo $password;
echo $fullname;
echo $company;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>TES INSERT CLIENT</title>

    <style>
        input {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" value="SUPP1001" placeholder="SUPP1001" disabled> <br>

            <label for="fullname">Full Name</label>
            <input type="text" name="fullname"> <br>

            <label for="company">Company</label>
            <input type="text" name="company"> <br>

            <label for="email">Email</label>
            <input type="email" name="email"> <br>

            <label for="telepon">Telepon</label>
            <input type="tel" name="telepon"> <br>

            <label for="password">Password</label>
            <input type="password" name="password"> <br>

            <button class="btn btn-primary mt-4" type="submit" name="signin">SIGN-IN</button>
            <!-- <button class="btn btn-warning mt-4" name="submitCompany">SIGN-IN Company</button> -->
        </form>
    </div>
</body>
</html>