<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

@$add_produk_status = $_SESSION['add-produk-status'];

$data_merk = mysqli_query($conn, "SELECT * FROM tb_merk");
$data_kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
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
            function alert_add_produk(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "Produk Baru Berhasil Ditambahkan";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "Produk Baru Gagal Ditambahkan";
                    icon_state = "error";
                }

                Swal.fire(
                    {title: title_state, text: text_state, icon: icon_state, showConfirmButton: false, timer: 2000}
                );
            }
        </script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-tambah-produk.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-tambah-produk.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <form
                            method="post"
                            action="./tambah-produk-process.php"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="card-header py-3">
                                                        <h5 class="m-0 font-weight-bold text-primary">Tambah Produk</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="foto">Foto</label>
                                                            <input type="file" name="foto" class="form-control" required="required"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tipe">Tipe</label>
                                                            <input type="text" name="tipe" class="form-control" required="required"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="harga">Harga</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                                                <input
                                                                    type="number"
                                                                    name="harga"
                                                                    class="form-control"
                                                                    aria-label="harga"
                                                                    aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsice">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="stok">Stok</label>
                                                            <input
                                                                type="number"
                                                                name="stok"
                                                                class="form-control"
                                                                value="0"
                                                                readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="merk">Merk</label>
                                                            <br>
                                                            <select class="js-select2-merk form-select" name="merk" style="width: 100%">
                                                                <?php foreach($data_merk as $result_merk) { ?>
                                                                <option value="<?= $result_merk['id_merk'] ?>"><?= $result_merk['merk'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="kategori">Kategori</label>
                                                            <br>
                                                            <select
                                                                class="js-select2-kategori"
                                                                name="kategori[]"
                                                                style="width: 100%"
                                                                multiple="multiple">
                                                                <?php foreach($data_kategori as $result_kategori) { ?>
                                                                <option value="<?= $result_kategori['id_kategori'] ?>"><?= $result_kategori['kategori'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <input type="submit" name="add-produk" value="Tambah" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("./footer-tambah-produk.php"); ?>

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
        if ($add_produk_status == 1) {
            echo "<script type='text/javascript'>
                alert_add_produk(1);
                setTimeout(() => {
                    document.location.href = '../data-produk/';
                }, 1500)
            </script>";
        } else if ($add_produk_status == 2) {
            echo "<script type='text/javascript'>
                alert_add_produk(2);
            </script>";
        }
        unset($_SESSION['add-produk-status']);
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
            $(document).ready(function () {
                $('.js-select2-merk').select2({placeholder: "Silahkan pilih merk"});
                $('.js-select2-kategori').select2({placeholder: "Silahkan pilih kategori"});
            });
        </script>
    </body>
</html>