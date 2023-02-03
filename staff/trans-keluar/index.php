<?php
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

$today = date("Y-m-d");

@$trans_out_status = $_SESSION['trans-out-status'];

$id_trans = [];
$trans_temp_id = mysqli_query($conn, "SELECT id_barang FROM tb_transaksi_detail_temp WHERE status = 'OUT' AND username = '$username'");
foreach ($trans_temp_id as $item) {
    $id_trans[] = $item['id_barang'];
}

$data_select = mysqli_query($conn, "SELECT * FROM tb_barang");
// $trans_temp = mysqli_query($conn, "SELECT * FROM tb_transaksi_detail_temp WHERE username = '$username'");
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
        
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                /* margin: 0; */
            }
        </style>
        <script src="../../js/sweetalert2@11.js"></script>
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
                let stok = parseInt(document.getElementById('stok').value);
                let jumlahKeluar = parseInt(document.getElementById('jumlah-keluar').value);
                let total = stok - jumlahKeluar;
                let stokAkhir = document.getElementById('stok-akhir');
                let invalidFeedback = document.getElementById('invalid-text');
                if (!isNaN(total)) {
                    if (jumlahKeluar > stok) {
                        stokAkhir.value = NaN;            
                        document.getElementById('jumlah-keluar').classList.add('is-invalid');
                        document.getElementById("invalid-text").innerHTML = "Jumlah Melebihi Batas Stok";
                        
                    } else if (jumlahKeluar < stok || jumlahKeluar == stok) {
                        if (jumlahKeluar < 0 || jumlahKeluar == 0) {
                            stokAkhir.value = NaN;
                            document.getElementById('jumlah-keluar').classList.add('is-invalid');
                            document.getElementById("invalid-text").innerHTML = "Jumlah Input Yang Dimasukkan Salah";
                        } else {
                            stokAkhir.value = total;
                            document.getElementById('jumlah-keluar').classList.remove('is-invalid');
                        }
                    } else {
                        stokAkhir.value = NaN;
                        document.getElementById('jumlah-keluar').classList.remove('is-invalid');
                    }
                } else {
                    stokAkhir.value = NaN;
                    document.getElementById('jumlah-keluar').classList.remove('is-invalid');
                }
                console.log(total);
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
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" value="<?= $today; ?>" class="form-control" readonly="readonly"/>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailProdukModal">Tambahkan Detail Produk</button>
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
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>No</th>
                                                                <th>Tipe</th>
                                                                <th>Merk</th>
                                                                <th>Jumlah Keluar</th>
                                                                <th>Stok Akhir</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $trans_temp = mysqli_query($conn, "SELECT * FROM tb_transaksi_detail_temp WHERE status = 'OUT'");
                                                            $no = 1;
                                                            foreach ($trans_temp as $trans) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $no; ?></td>
                                                                    <td><?= $trans['tipe']; ?></td>
                                                                    <td><?= ucwords($trans['merk']); ?></td>
                                                                    <td class="text-center"><?= $trans['jumlah']; ?></td>
                                                                    <td class="text-center"><?= $trans['stok_akhir']; ?></td>
                                                                    <td class="text-center">
                                                                        <a href="./trans-temp-process.php?delete=<?= $trans['id_barang']; ?>">
                                                                            <button type="button" class="btn btn-outline-danger" id="btn-delete-trans">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </a>
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

        <!-- Detail Produk Modal-->
        <div
            class="modal fade"
            id="detailProdukModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Detail Produk</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="./trans-temp-process.php" method="post">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="select-produk">Pilih Produk</label>
                                                <br>
                                                <select class="js-select2-select-produk form-select" onchange="requestSelect()" name="select-produk" id="select-produk" style="width: 100%">
                                                    <?php foreach ($data_select as $result_select) { 
                                                        if (!in_array($result_select['id_barang'], $id_trans)) {
                                                    ?>
                                                            <option value="" readonly></option>
                                                            <option value="<?=$result_select['id_barang']; ?>"><?= $result_select['tipe']; ?></option>
                                                    <?php
                                                        }
                                                    } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="jumlah-keluar">Jumlah Keluar</label>
                                                <input type="number" id="jumlah-keluar" onkeyup="stokFinal()" name="jumlah-keluar" class="form-control" min="1" required/>
                                                <p class="invalid-feedback" id="invalid-text"></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="stok-akhir">Stok Akhir</label>
                                                <input type="number" id="stok-akhir" name="stok-akhir" class="form-control" readonly/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 ml-auto">                                    
                                        <!-- <div class="form-group">
                                            <div class="form-line">
                                                <label for="id-barang">ID Barang</label>
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="hidden" id="id-barang" name="id-barang" class="form-control" readonly="readonly"/>
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
                                                <label for="harga">Harga</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    <input
                                                        type="text"
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
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit" name="add-detail-produk">Tambah</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>

    <?php 
        if ($trans_out_status == 1) {
            echo "<script type='text/javascript'>
                alert_trans_out(1);
                setTimeout(() => {
                    document.location.href = '../data-transaksi/';
                }, 1500)
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

        <script src="../../js/select2.min.js"></script>

        <script type="text/javascript">
            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href)
            }

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
                // console.log(response);

                $('#id-barang').val(result.id_barang);
                $('#foto').attr("src", "../../assets/img/barang/" + result.foto);
                $('#tipe').val(result.tipe);
                $('#harga').val(number_format(result.harga, 2, ',', '.'));
                $('#stok').val(result.stok);
                $('#merk').val(result.merk);
                $('#jumlah-keluar').val(NaN);
                $('#jumlah-keluar').attr({
                    "max" : result.stok
                });

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