<?php 
include "../../functions/connection.php";
session_start();
if (!$_SESSION['signin']) {
    header("Location: ../signin/");
    exit;
} else if ($_SESSION['user_role'] == "supplier") {
    header("Location: ../supplier/");
    exit;
}
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

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            function alert_delete_produk() {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data akan terhapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: "Batal",
                    confirmButtonText: 'Ya, saya yakin!'
                }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Data berhasil terhapus!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    });
            }
        </script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-user.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-user.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Nama Lengkap</th>
                                                <th>Foto</th>
                                                <th>Perusahaan</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                            $no = 1;
                                            $query = "SELECT * FROM tb_user WHERE role = 'supplier'";
                                            $data = mysqli_query($conn, $query);
                                            while ($result = mysqli_fetch_array($data)) {
                                            ?>

                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $result['username'] ?></td>
                                                <td><?= $result['nama_lengkap'] ?></td>

                                                <td> <img src="<?= "../../assets/img/user-foto/supplier/".$result['foto'] ?>" style="height: 50px; width: 50px;"></td>
                                                <td><?= $result['perusahaan'] ?></td>

                                                <td><?= $result['email'] ?></td>
                                                <td><?= $result['telepon'] ?></td>
                                                <td><?= strtoupper($result['role']) ?></td>
                                                <td>
                                                        <a href="../edit-user/index.php?edit=<?= $result['username'] ?>" class="btn btn-success">Ubah</a>
                                                        <a onclick="alert_delete_produk()" class="btn btn-danger" >Hapus</a>
                                                    </td>
                                            </tr>
                                            <?php 
                                                $no++;
                                            }?>
                                            <a href="../tambah-user/" class="btn btn-primary">Tambah Supplier</a>
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
        <?php include("./footer-user.php"); ?>

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
                <a class="btn btn-primary" href="../signout.php">Ya</a>
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

<!-- Page level plugins -->
<script src="../../js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../js/chart-area-demo.js"></script>
<script src="../../js/chart-pie-demo.js"></script>

</body>
</html>