<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "manager");

@$edit_pw_status = $_SESSION['edit-pw-status'] ?? 0;
$username = $_SESSION['username'];
$query = "SELECT * FROM tb_user WHERE username = '$username'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
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
        
        <script src="../../js/sweetalert2@11.js"></script>
        <script type="text/javascript">
            function alert_edit_pw(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "Password Berhasil Diganti!";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "Password Lama Tidak Cocok!";
                    icon_state = "error";
                }

                Swal.fire({
                    title: title_state, 
                    text: text_state, 
                    icon: icon_state,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        </script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-edit-pw.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-edit-pw.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <form
                        method="post"
                        action="./edit-pw-process.php">

                            <div class="row">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="card-header py-3">
                                                        <h5 class="font-weight-bold text-primary">Ganti Password</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col col-md-12">
                                    <div class="card shadow mb-1">
                                        <div class="card-body py-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="pw-old">Masukkan password lama</label>
                                                    <input type="password" name="pw-old" class="form-control">
                                                </div>
                                                <div class="form-line">
                                                    <label for="pw-old">Masukkan password baru</label>
                                                    <input type="password" name="pw-new" class="form-control">
                                                </div>
                                                <!-- <div class="form-line">
                                                    <label for="pw-old">Konfirmasi password </label>
                                                    <input type="password" name="pw-old" class="form-control">
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="edit-pw" value="Simpan" class="btn btn-primary">
                        </form>
                    </div>
                    <!-- /.container-fluid -->
                    
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("./footer-edit-pw.php"); ?>

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
        
        if ($edit_pw_status == 1) {
            echo "<script type='text/javascript'>alert_edit_pw(1);
                setTimeout(() => {
                    document.location.href = '../profile/';
                }, 1500)
            </script>";
        } else if ($edit_pw_status == 2) {
            echo "<script type='text/javascript'>alert_edit_pw(2);</script>";
        }
        unset($_SESSION['edit-pw-status']);
        ?>

        <!-- Bootstrap core JavaScript-->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../js/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>
    </body>
</html>