<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

$username = $_SESSION['username'];
$query = "SELECT * FROM tb_user WHERE username = '$username'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../css/all.min.css">
        <link rel="stylesheet" href="../../css/sb-admin-2.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

        <title>Profile Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-profile.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("navbar-profile.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="body">
                                                <div class="card-header py-3">
                                                    <h3 class="font-weight-bold text-primary">Profile</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Profile -->
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                    <?php 
                                if ($result['role'] == "staff") {
                                    $location = "../../assets/img/user-foto/staff/";
                                } else if ($result['role'] == "supplier") {
                                    $location = "../../assets/img/user-foto/supplier/";
                                } else if ($result['role'] == "manager") {
                                    $location = "../../assets/img/user-foto/manager/";
                                }
                                ?>
                                        <img
                                            src="<?= $location . $result['foto'] ?>"
                                            class="rounded img-profile img-fluid"
                                            style="width: 40%;"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Username</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                        <p><?= strtoupper($result['username']); ?></p>
                                    </div>
                                </div>

                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Nama Lengkap</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                        <p><?= ucwords($result['nama_lengkap']); ?></p>
                                    </div>
                                </div>

                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                        <p><?= strtoupper($result['role']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-md-6">
                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Perusahaan</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                        <p><?= ucwords($result['perusahaan']); ?></p>
                                    </div>
                                </div>

                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Email :</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                        <p><?= $result['email']; ?></p>
                                    </div>
                                </div>
                                <div class="card shadow mb-1">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Telepon :</h6>
                                    </div>
                                    <div class="card-body py-sm-2">
                                        <p><?= $result['telepon']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End for Profile -->
                        <a href="../edit-profile/" class="btn btn-success mt-3">Edit Profile</a>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("./footer-profile.php"); ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div
            class="modal fade"
            id="logoutModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Ya" untuk keluar. Dan silahkan masuk kembali</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                        <a class="btn btn-primary" href="../../signout.php">Ya</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../js/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>
    </body>
</html>