<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <title>Sign-Up | Stormz</title>
</head>
<body class="bg-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <?php @$error = $_GET['error'];
                                if ($error == 1) {?>
                                    <div class="alert alert-danger" role="alert">
                                        Data gagal ditambahkan!
                                    </div>
                            <?php } ?>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tambah User Staff/Supplier</h1>
                            </div>
                            <form class="user" action="signup-process.php" method="post">
                                <div class="form-group">
                                    <label for="user_kode" class="form-label">Kode User</label>
                                    <input class="form-control" id="userKode" name="user_kode" value="STAFF-1001" type="text" aria-label="Disabled input example" disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="user_fullname" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user" name="user_fullname" placeholder="Masukkan Nama Lengkap..." name="user_fullname">
                                </div>
                                <div class="form-group">
                                    <label for="user_company" class="form-label">Perusahaan</label>
                                    <input type="text" class="form-control form-control-user" name="user_company" placeholder="Masukkan Nama Perusahaan..." name="user_company">
                                </div>
                                <div class="form-group">
                                    <label for="user_email" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-user" name="user_email" placeholder="Masukkan Email..." name="user_email" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_password" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-user" name="user_password" placeholder="Masukkan Password..." name="user_password" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" id="selectRole" aria-label="Default select example" name="role_select">
                                        <option selected>Pilih Kategori:</option>
                                        <option value="staff">Staff</option>
                                        <option value="supplier">Supplier</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="signup">Tambah User</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="../signin/">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>
</html>