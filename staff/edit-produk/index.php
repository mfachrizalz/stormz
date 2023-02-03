<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

@$edit_produk_status = $_SESSION['edit-produk-status'] ?? 0;
@$edit_id = $_GET['edit'];

$query = "SELECT tb_barang.id_barang, tb_barang.foto, tb_barang.tipe, tb_barang.harga, tb_stok.stok, tb_merk.merk, tb_merk.id_merk
        FROM tb_barang
        INNER JOIN tb_merk
        ON tb_merk.id_merk = tb_barang.id_merk
        INNER JOIN tb_stok
        ON tb_barang.id_barang = tb_stok.id_barang
        WHERE tb_barang.id_barang = '$edit_id'
        ";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);

$data_merk = mysqli_query($conn, "SELECT * FROM tb_merk");

$query_kategori_barang = "SELECT * FROM tb_kategori_barang 
                    INNER JOIN  tb_kategori 
                    ON tb_kategori.id_kategori = tb_kategori_barang.id_kategori 
                    WHERE tb_kategori_barang.id_barang = '$edit_id'
                    ";
$data_kategori_barang = mysqli_query($conn, $query_kategori_barang);

// foreach ($data_kategori_barang as $result_kategori_barang) {
//     var_dump($result_kategori_barang['id_kategori']);
// }
// exit;

$data_kategori = mysqli_query($conn, "SELECT * FROM tb_kategori")
// $result_kategori = mysqli_fetch_assoc($data_kategori);
// var_dump($result_kategori);
// exit;
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
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="../../js/sweetalert2@11.js"></script>
        <script type="text/javascript">
            function alert_edit_produk(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "Produk Berhasil Diedit";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "Produk Gagal Diedit";
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
            <?php include("./sidebar-edit-produk.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-edit-produk.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="body">
                                                <div class="card-header py-3">
                                                    <h5 class="font-weight-bold text-primary">Edit Produk</h5>
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
                                                <form
                                                    method="post"
                                                    action="./edit-produk-process.php"
                                                    enctype="multipart/form-data">

                                                    <label for="id-produk">ID Produk</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <input
                                                        name="id-produk"
                                                        class="form-control"
                                                        value="<?= $result['id_barang']; ?>"
                                                        readonly/>
                                                        </div>
                                                    </div>

                                                    <label for="foto">Foto</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <img src="../../assets/img/barang/<?= $result['foto'] ?>" alt="" class="rounded img-profile" style="height: 200px; width: auto;">
                                                            <input type="hidden" name="foto-old" value="<?= $result['foto'] ?>" class="form-control"/>
                                                            <input type="file" name="foto" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <label for="tipe">Tipe</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="tipe" value="<?= $result['tipe']; ?>" class="form-control" required="required"/>
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
                                                    <label for="harga">Harga</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        <input
                                                            type="number"
                                                            name="harga" 
                                                            value="<?= $result['harga'] ?>"
                                                            class="form-control"
                                                            aria-label="harga"
                                                            aria-describedby="basic-addon1">
                                                    </div>

                                                    <label for="stok">Stok</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="number" name="stok" value="<?= $result['stok'] ?>" class="form-control" readonly/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="merk">Merk</label> <br>
                                                            <select class="js-select2-merk form-select" name="merk" style="width: 100%">
                                                                <?php foreach($data_merk as $result_merk) { ?>
                                                                    <option value="<?= $result_merk['id_merk'] ?>"
                                                                        <?php 
                                                                        if ($result_merk['id_merk'] == $result['id_merk']) {
                                                                            echo "selected";
                                                                        }
                                                                        ?>
                                                                    ><?= $result_merk['merk'] ?></option>
                                                                <?php } ?>
                                                            </select>                            
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="kategori">Kategori</label> <br>
                                                            <select class="js-select2-kategori" name="kategori[]" style="width:100%" multiple="multiple">
                                                                <?php foreach ($data_kategori as $result_kategori) { ?>
                                                                    <option value="<?= $result_kategori['id_kategori'] ?>"
                                                                    <?php 
                                                                    foreach ($data_kategori_barang as $result_kategori_barang) {
                                                                        if ($result_kategori_barang['id_kategori'] == $result_kategori['id_kategori']) {
                                                                            echo "selected";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    ><?= $result_kategori['kategori'] ?></option>
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
                                                    <input type="submit" name="edit-produk" value="Simpan" class="btn btn-primary">
                                                </form>
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
                <?php include("./footer-edit-produk.php"); ?>

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
        
        if ($edit_produk_status == 1) {
            echo "<script type='text/javascript'>alert_edit_produk(1);
                setTimeout(() => {
                    document.location.href = '../data-produk/';
                }, 1500)
            </script>";
        } else if ($edit_produk_status == 2) {
            echo "<script type='text/javascript'>alert_edit_produk(2);</script>";
        }
        unset($_SESSION['edit-produk-status']);
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