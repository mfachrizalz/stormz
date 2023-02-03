<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "manager");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

@$add_user_status = $_SESSION['add-user-status'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../css/all.min.css">
        <link rel="stylesheet" href="../../css/sb-admin-2.min.css">
        <link rel="stylesheet" href="../../css/select2.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

        <script src="../../js/sweetalert2@11.js"></script>
        <script type="text/javascript">
            function alert_add_user(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "User Baru Berhasil Ditambahkan";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "User Baru Gagal Ditambahkan";
                    icon_state = "error";
                }

                Swal.fire(
                    {title: title_state, text: text_state, icon: icon_state, showConfirmButton: false, timer: 2000}
                );
            }
        </script>

        <title>Manager | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-tambah-staff.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-tambah-staff.php"); ?>

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
                                            action="./tambah-staff-process.php"
                                            enctype="multipart/form-data">
                                            <label for="username">Username</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input
                                                        name="username"
                                                        class="form-control"
                                                        value="<?= strtoupper(add_staff()); ?>"
                                                        readonly/>
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
                                                name="add-staff"
                                                value="Tambah"
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
                <?php include("./footer-tambah-staff.php"); ?>

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
        if ($add_user_status == 1) {
            echo "<script type='text/javascript'>
                alert_add_user(1);
                setTimeout(() => {
                    document.location.href = '../kelola-user/';
                }, 1500)
            </script>";
        } else if ($add_user_status == 2) {
            echo "<script type='text/javascript'>
                alert_add_user(2);
            </script>";
        }
        unset($_SESSION['add-user-status']);
        ?>

        <!-- Bootstrap core JavaScript-->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../js/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>

        <script src="../../js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.js-select2-merk').select2({
                    placeholder: "Silahkan pilih merk"
                });
                $('.js-select2-kategori').select2({
                    placeholder: "Silahkan pilih kategori"
                });
            });
        </script>
    </body>
</html>