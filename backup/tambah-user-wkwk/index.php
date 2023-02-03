<?php 
include "../../functions/connection.php";
include "../../functions/functions.php";

session_start();
if (!$_SESSION['signin']) {
    header("Location: ../signin/");
    exit;
} else if ($_SESSION['user_role'] == "supplier") {
    header("Location: ../supplier/");
    exit;
}

@$add_user_status = $_SESSION['add-user-status'];
// $add_user_status = 2;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../css/all.min.css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="../../css/sb-admin-2.min.css">

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-tambah-user.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-tambah-user.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Supplier</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="body">

                                        <form
                                            method="post"
                                            action="./tambah-user-process.php"
                                            enctype="multipart/form-data">
                                            <label for="username">Username</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input
                                                        name="username"
                                                        class="form-control"
                                                        value="<?= strtoupper(add_supplier()); ?>"
                                                        disabled="disabled"/>
                                                </div>
                                            </div>

                                            <label for="password">Password</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input
                                                        type="password"
                                                        name="password"
                                                        class="form-control"
                                                        required="required"/>
                                                </div>
                                            </div>

                                            <label for="fullname">Nama Lengkap</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="fullname" class="form-control" required="required"/>
                                                </div>
                                            </div>

                                            <label for="company">Perusahaan</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="company" class="form-control" required="required"/>
                                                </div>
                                            </div>

                                            <label for="">Email</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="email" name="email" class="form-control" required="required"/>
                                                </div>
                                            </div>

                                            <label for="telepon">Telepon</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="tel" name="telepon" class="form-control" required="required"/>
                                                </div>
                                            </div>

                                            <label for="foto">Foto</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="foto" class="form-control" required="required"/>
                                                </div>
                                            </div>

                                            <input
                                                type="submit"
                                                name="add-user"
                                                value="Tambah User"
                                                class="btn btn-primary">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("./footer-tambah-user.php"); ?>

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

        <?php 
        if ($add_user_status = 1) {
        ?>
            <script type="text/javascript">
                swal({
                    title: "Sukses!", 
                    text: "Data User Berhasil Ditambahkan", 
                    icon: "success",
                });
            </script>
        <?php
            $add_user_status = 0;
            unset($_SESSION['add-user-status']);
            } else if ($add_user_status = 2) {
        ?>
            <script type="text/javascript">
                swal({
                    title: "Gagal!", 
                    text: "Data User Gagal Ditambahkan", 
                    icon: "error",
                });
            </script>
        <?php
            $add_user_status = 0;
            unset($_SESSION['add-user-status']);
        }
        ?>

        <!-- Bootstrap core JavaScript-->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../js/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../../js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../js/chart-area-demo.js"></script>
        <script src="../../js/chart-pie-demo.js"></script>

    </body>
</html>