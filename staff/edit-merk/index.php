<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

@$edit_merk_status = $_SESSION['edit-merk-status'] ?? 0;
@$edit_id = $_GET['edit'];
$query = "SELECT * FROM tb_merk WHERE id_merk = '$edit_id'";
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

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="../../js/sweetalert2@11.js"></script>
        <script type="text/javascript">
            function alert_edit_merk(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "Merk Berhasil Diedit";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "Merk Gagal Diedit";
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
            <?php include("./sidebar-edit-merk.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-edit-merk.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="body">
                                                <div class="card-header py-3 mb-4">
                                                    <h5 class="m-0 font-weight-bold text-primary">Edit Merk</h5>
                                                </div>

                                                <div class="col col-md-7">
                                                    <form method="post" action="./edit-merk-process.php" enctype="multipart/form-data">
                                                        <label for="id-merk">ID Merk</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" name="id-merk" value="<?= $result['id_merk'] ?>" class="form-control" readonly/>
                                                            </div>
                                                        </div>

                                                        <label for="merk">Nama Merk</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" name="merk" value="<?= $result['merk'] ?>" class="form-control" required="required"/>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="submit" name="edit-merk" value="Simpan" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                    
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("./footer-edit-merk.php"); ?>

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
        
        if ($edit_merk_status == 1) {
            echo "<script type='text/javascript'>alert_edit_merk(1);
                setTimeout(() => {
                    document.location.href = '../data-merk/';
                }, 1500)
            </script>";
        } else if ($edit_merk_status == 2) {
            echo "<script type='text/javascript'>alert_edit_merk(2);</script>";
        }
        unset($_SESSION['edit-merk-status']);
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