<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "manager");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

$query = "SELECT tb_barang.id_barang, tb_barang.foto, tb_barang.tipe, tb_barang.harga, tb_stok.stok, tb_merk.merk
        FROM tb_barang
        INNER JOIN tb_merk
        ON tb_merk.id_merk = tb_barang.id_merk
        INNER JOIN tb_stok
        ON tb_barang.id_barang = tb_stok.id_barang
        ";
$data = mysqli_query($conn, $query);
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

        <title>Manager | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-data-produk.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-data-produk.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Tipe</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Merk</th>
                                                <th>Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($data as $result) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><img
                                                    src="../../assets/img/barang/<?= $result['foto'];?>"
                                                    style="height: 50px; width: 50px;"></td>
                                                <td><?= strtoupper($result['tipe']); ?></td>
                                                <td><?= "Rp".number_format($result['harga'], 2, ',', '.'); ?></td>
                                                <td class="text-center"><?= $result['stok']; ?></td>
                                                <td><?= ucwords($result['merk']); ?></td>
                                                <td>
                                                    <ol class="list-group">
                                                        <?php
                                                        $id_barang = $result['id_barang'];
                                                        $data_kategori = mysqli_query($conn, "SELECT * FROM tb_kategori_barang INNER JOIN  tb_kategori ON tb_kategori.id_kategori = tb_kategori_barang.id_kategori WHERE tb_kategori_barang.id_barang = '$id_barang'");
                                                        foreach ($data_kategori as $kategori) {
                                                        ?>
                                                            <li class="list-group-item"><?= ucwords($kategori['kategori']); ?></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ol>
                                                </td>
                                            </tr>
                                            <?php 
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("./footer-data-produk.php"); ?>

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