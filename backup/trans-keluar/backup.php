<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");

$today = date("Y-m-d");

@$trans_out_status = $_SESSION['trans-out-status'];

$data_select = mysqli_query($conn, "SELECT * FROM tb_barang");

// $query = "SELECT tb_barang.id_barang, tb_barang.foto, tb_barang.tipe, tb_barang.harga, tb_stok.stok, tb_merk.merk
//         FROM tb_barang
//         INNER JOIN tb_merk
//         ON tb_merk.id_merk = tb_barang.id_merk
//         INNER JOIN tb_stok
//         ON tb_barang.id_barang = tb_stok.id_barang
//         ";
// $data = mysqli_query($conn, $query);
// $id_barang = $_POST['select_produk'];
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

        <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"/>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            function alert_trans_out(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "Transaksi Berhasil Ditambahkan";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "Transaksi Gagal Ditambahkan";
                    icon_state = "error";
                }

                Swal.fire(
                    {title: title_state, text: text_state, icon: icon_state, showConfirmButton: false, timer: 2000}
                );
            }

            function stokFinal() {
                let stok = document.getElementById('stok').value;
                let jumlahKeluar = document.getElementById('jumlah-keluar').value;
                let total = parseInt(stok) - parseInt(jumlahKeluar);
                let stokAkhir = document.getElementById('stok-akhir');
                if (!isNaN(total)) {
                    stokAkhir.value = total;
                } else {
                    stokAkhir.value = stok;
                }
            }
        </script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-trans-keluar.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-trans-keluar.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <form
                            method="post"
                            action="./trans-keluar-process.php"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="card-header py-3">
                                                        <h5 class="m-0 font-weight-bold text-primary">Input Transaksi Keluar</h5>
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
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Transaksi:</h6>
                                        </div>
                                        <div class="card-body py-sm-2">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line mb-4">
                                                            <label for="id-transaksi">ID Transaksi</label>
                                                            <input type="text" name="id-transaksi" value="<?= id_transaction("out"); ?>" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="add-produk-transaction" class="btn btn-success">Tambahkan Produk</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Produk 1:</h6>
                                        </div>
                                        <div class="card-body py-sm-2">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" value="<?= $today; ?>" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="select-produk">Pilih Produk</label>
                                                            <br>
                                                            <select class="js-select2-select-produk form-select" name="select-produk" id="select-produk" style="width: 100%">
                                                                <?php foreach($data_select as $result_select) { ?>
                                                                <option value="<?=$result_select['id_barang'] ?>"><?=$result_select['tipe'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="jumlah-keluar">Jumlah Keluar</label>
                                                            <input type="number" id="jumlah-keluar" onkeyup="stokFinal()" name="jumlah-keluar" class="form-control" required/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="stok-akhir">Stok Akhir</label>
                                                            <input type="number" id="stok-akhir" name="stok-akhir" class="form-control" readonly value=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Data Produk 1:</h6>
                                        </div>
                                        <div class="card-body py-sm-2">
                                            <div class="table-responsice">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="id-barang">ID Barang</label>
                                                            <input type="text" id="id-barang" name="id-barang" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="foto">Foto</label> <br>
                                                            <img id="foto" src="" class="rounded img-profile img-fluid" style="max-height: 10em; object-fit: contain; width: auto;" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tipe">Tipe</label>
                                                            <input type="text" id="tipe" name="tipe" class="form-control" readonly="readonly"/>
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
                                                                    id="harga"
                                                                    class="form-control"
                                                                    aria-label="harga"
                                                                    aria-describedby="basic-addon1"
                                                                    readonly="readonly">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="stok">Stok</label>
                                                            <input
                                                                type="number"
                                                                name="stok"
                                                                id="stok"
                                                                class="form-control"
                                                                value="0"
                                                                readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="merk">Merk</label>
                                                            <input type="text" id="merk" name="merk" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="kategori">Kategori</label>
                                                            <select id="kategori" class="js-select2-kategori" name="kategori[]" readonly="readonly" style="width:100%" multiple="multiple" disabled>
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
                                                    <input type="submit" name="trans-out" value="Tambah" class="btn btn-primary">
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
                <?php include("./footer-trans-keluar.php"); ?>

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
        if ($trans_out_status == 1) {
            echo "<script type='text/javascript'>
                alert_trans_out(1);
                // setTimeout(() => {
                //     document.location.href = '../data-produk/';
                // }, 1500)
            </script>";
        } else if ($trans_out_status == 2) {
            echo "<script type='text/javascript'>
                alert_trans_out(2);
            </script>";
        }
        unset($_SESSION['trans-out-status']);
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

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script type="text/javascript">
            

            $(document).ready(function () {
                $('.js-select2-merk').select2({placeholder: "Silahkan pilih merk"});
                $('.js-select2-kategori').select2({placeholder: "Silahkan pilih kategori"});
                $('.js-select2-select-produk').select2({placeholder: "Silahkan pilih produk"});
            });

            async function requestSelect() {
                let select_produk = $(this).val();

                const data = await $.ajax({
                    type: 'POST',
                    url: 'select-produk.php',
                    dataType: 'JSON',
                    data: 'select_produk=' + select_produk,
                    success: function(response) {
                        return response;
                    }
                });

                let result = data[0];

                $('#id-barang').val(result.id_barang);
                $('#foto').attr("src", "../../assets/img/barang/" + result.foto);
                $('#tipe').val(result.tipe);
                $('#harga').val(result.harga);
                $('#stok').val(result.stok);
                $('#merk').val(result.merk);

                $('#kategori').empty()
                for (let i = 0; i < result.kategori.length; i++) {
                    $('#kategori').append('<option selected class="opt-kategori" value="' + result.kategori[i] + '">' + result.kategori[i] + '</option>');
                }
            }

            $('#select-produk').change(requestSelect);
            // $('#select-produk').load(requestSelect);
        </script>
    </body>
</html>







<!-- KE 2 -->
<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");

$today = date("Y-m-d");

@$trans_out_status = $_SESSION['trans-out-status'];

$data_select = mysqli_query($conn, "SELECT * FROM tb_barang");

// $query = "SELECT tb_barang.id_barang, tb_barang.foto, tb_barang.tipe, tb_barang.harga, tb_stok.stok, tb_merk.merk
//         FROM tb_barang
//         INNER JOIN tb_merk
//         ON tb_merk.id_merk = tb_barang.id_merk
//         INNER JOIN tb_stok
//         ON tb_barang.id_barang = tb_stok.id_barang
//         ";
// $data = mysqli_query($conn, $query);
// $id_barang = $_POST['select_produk'];
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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

        <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"/>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            function alert_trans_out(status) {
                let title_state;
                let text_state;
                let icon_state;
                if (status == 1) {
                    title_state = "Sukses!";
                    text_state = "Transaksi Berhasil Ditambahkan";
                    icon_state = "success";
                } else if (status == 2) {
                    title_state = "Gagal!";
                    text_state = "Transaksi Gagal Ditambahkan";
                    icon_state = "error";
                }

                Swal.fire(
                    {title: title_state, text: text_state, icon: icon_state, showConfirmButton: false, timer: 2000}
                );
            }

            function stokFinal() {
                let stok = document.getElementById('stok').value;
                let jumlahKeluar = document.getElementById('jumlah-keluar').value;
                let total = parseInt(stok) - parseInt(jumlahKeluar);
                let stokAkhir = document.getElementById('stok-akhir');
                if (!isNaN(total)) {
                    stokAkhir.value = total;
                } else {
                    stokAkhir.value = stok;
                }
            }
        </script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-trans-keluar.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-trans-keluar.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <form
                            method="post"
                            action="./trans-keluar-process.php"
                            enctype="multipart/form-data">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="body">
                                                <div class="card-header py-3">
                                                    <h5 class="m-0 font-weight-bold text-primary">Input Transaksi Keluar</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Transaksi:</h6>
                                        </div>
                                        <div class="card-body py-sm-2">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line mb-4">
                                                            <label for="id-transaksi">ID Transaksi</label>
                                                            <input type="text" name="id-transaksi" value="<?= id_transaction("out"); ?>" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" value="<?= $today; ?>" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="add-produk-transaction" class="btn btn-success">Tambahkan Produk</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group" id="items">
                                <li class="list-group-item mb-3">
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <div class="card mb-2">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Produk 1:</h6>
                                                </div>
                                                <div class="card-body py-sm-2">
                                                    <div class="table-responsive">
                                                        <div class="body">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="select-produk">Pilih Produk</label>
                                                                    <br>
                                                                    <select class="js-select2-select-produk form-select" name="select-produk" id="select-produk" style="width: 100%">
                                                                        <?php foreach($data_select as $result_select) { ?>
                                                                        <option value="<?=$result_select['id_barang'] ?>"><?=$result_select['tipe'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="jumlah-keluar">Jumlah Keluar</label>
                                                                    <input type="number" id="jumlah-keluar" onkeyup="stokFinal()" name="jumlah-keluar" class="form-control" required/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="stok-akhir">Stok Akhir</label>
                                                                    <input type="number" id="stok-akhir" name="stok-akhir" class="form-control" readonly value=""/>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-outline-danger">
                                                                <i class="bi bi-trash-fill"></i>
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col col-md-6">
                                            <div class="card mb-2">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Data Produk 1:</h6>
                                                </div>
                                                <div class="card-body py-sm-2">
                                                    <div class="table-responsice">
                                                        <div class="body">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="id-barang">ID Barang</label>
                                                                    <input type="text" id="id-barang" name="id-barang" class="form-control" readonly="readonly"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="foto">Foto</label> <br>
                                                                    <img id="foto" src="" class="rounded img-profile img-fluid" style="max-height: 10em; object-fit: contain; width: auto;" alt="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="tipe">Tipe</label>
                                                                    <input type="text" id="tipe" name="tipe" class="form-control" readonly="readonly"/>
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
                                                                            id="harga"
                                                                            class="form-control"
                                                                            aria-label="harga"
                                                                            aria-describedby="basic-addon1"
                                                                            readonly="readonly">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="stok">Stok</label>
                                                                    <input
                                                                        type="number"
                                                                        name="stok"
                                                                        id="stok"
                                                                        class="form-control"
                                                                        value="0"
                                                                        readonly="readonly"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="merk">Merk</label>
                                                                    <input type="text" id="merk" name="merk" class="form-control" readonly="readonly"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label for="kategori">Kategori</label>
                                                                    <select id="kategori" class="js-select2-kategori" name="kategori[]" readonly="readonly" style="width:100%" multiple="multiple" disabled>
                                                                    </select>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <!-- <div class="row">
                                <div class="col col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Produk 1:</h6>
                                        </div>
                                        <div class="card-body py-sm-2">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" value="<?= $today; ?>" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="select-produk">Pilih Produk</label>
                                                            <br>
                                                            <select class="js-select2-select-produk form-select" name="select-produk" id="select-produk" style="width: 100%">
                                                                <?php foreach($data_select as $result_select) { ?>
                                                                <option value="<?=$result_select['id_barang'] ?>"><?=$result_select['tipe'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="jumlah-keluar">Jumlah Keluar</label>
                                                            <input type="number" id="jumlah-keluar" onkeyup="stokFinal()" name="jumlah-keluar" class="form-control" required/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="stok-akhir">Stok Akhir</label>
                                                            <input type="number" id="stok-akhir" name="stok-akhir" class="form-control" readonly value=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Data Produk 1:</h6>
                                        </div>
                                        <div class="card-body py-sm-2">
                                            <div class="table-responsice">
                                                <div class="body">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="id-barang">ID Barang</label>
                                                            <input type="text" id="id-barang" name="id-barang" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="foto">Foto</label> <br>
                                                            <img id="foto" src="" class="rounded img-profile img-fluid" style="max-height: 10em; object-fit: contain; width: auto;" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tipe">Tipe</label>
                                                            <input type="text" id="tipe" name="tipe" class="form-control" readonly="readonly"/>
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
                                                                    id="harga"
                                                                    class="form-control"
                                                                    aria-label="harga"
                                                                    aria-describedby="basic-addon1"
                                                                    readonly="readonly">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="stok">Stok</label>
                                                            <input
                                                                type="number"
                                                                name="stok"
                                                                id="stok"
                                                                class="form-control"
                                                                value="0"
                                                                readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="merk">Merk</label>
                                                            <input type="text" id="merk" name="merk" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="kategori">Kategori</label>
                                                            <select id="kategori" class="js-select2-kategori" name="kategori[]" readonly="readonly" style="width:100%" multiple="multiple" disabled>
                                                            </select>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <script>
                                const btnTransaction = document.getElementById("add-produk-transaction");
                                const items = document.getElementById("items");
                                
                                btnTransaction.addEventListener("click", function() {

                                    items.innerHTML += `
                                        
                                    `;
                                });
                            </script>

                            <div class="row">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="body">
                                                    <input type="submit" name="trans-out" value="Tambah" class="btn btn-primary">
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
                <?php include("./footer-trans-keluar.php"); ?>

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
        if ($trans_out_status == 1) {
            echo "<script type='text/javascript'>
                alert_trans_out(1);
                // setTimeout(() => {
                //     document.location.href = '../data-produk/';
                // }, 1500)
            </script>";
        } else if ($trans_out_status == 2) {
            echo "<script type='text/javascript'>
                alert_trans_out(2);
            </script>";
        }
        unset($_SESSION['trans-out-status']);
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

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script type="text/javascript">
            

            $(document).ready(function () {
                $('.js-select2-merk').select2({placeholder: "Silahkan pilih merk"});
                $('.js-select2-kategori').select2({placeholder: "Silahkan pilih kategori"});
                $('.js-select2-select-produk').select2({placeholder: "Silahkan pilih produk"});
            });

            async function requestSelect() {
                let select_produk = $(this).val();

                const data = await $.ajax({
                    type: 'POST',
                    url: 'select-produk.php',
                    dataType: 'JSON',
                    data: 'select_produk=' + select_produk,
                    success: function(response) {
                        return response;
                    }
                });

                let result = data[0];

                $('#id-barang').val(result.id_barang);
                $('#foto').attr("src", "../../assets/img/barang/" + result.foto);
                $('#tipe').val(result.tipe);
                $('#harga').val(result.harga);
                $('#stok').val(result.stok);
                $('#merk').val(result.merk);

                $('#kategori').empty()
                for (let i = 0; i < result.kategori.length; i++) {
                    $('#kategori').append('<option selected class="opt-kategori" value="' + result.kategori[i] + '">' + result.kategori[i] + '</option>');
                }
            }

            $('#select-produk').change(requestSelect);
            // $('#select-produk').load(requestSelect);
        </script>
    </body>
</html>