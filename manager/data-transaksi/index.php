<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "manager");
$username = $_SESSION['username'];

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);
$data_year = mysqli_query($conn, "SELECT * FROM tb_transaksi");

$today = date("Y-m-d");

$select_year = @$_SESSION['select-year'];
$select_month = @$_SESSION['select-month'];

if (!isset($_SESSION['select-year'])) {
    $select_year = 0;
} 
if (!isset($_SESSION['select-month'])) {
    $select_month = 0;
}

$w_month = "MONTH(tb_transaksi.tanggal) = " . $select_month;
$w_year = "YEAR(tb_transaksi.tanggal) = " . $select_year;

if ($select_year == 0 && $select_month == 0) {
    $where = "";
} else {
    $where = "WHERE " . $w_month . " AND " . $w_year;
}

echo "
    <script>
        console.log('".$where."');
        console.log('session year = ".$select_year."');
        console.log('session month = ".$select_month."');
    </script>
";

$query = "SELECT * FROM tb_transaksi
        INNER JOIN tb_transaksi_detail
        ON tb_transaksi_detail.id_transaksi = tb_transaksi.id_transaksi
        INNER JOIN tb_stok
        ON tb_transaksi_detail.id_stok = tb_stok.id_stok
        INNER JOIN tb_barang
        ON tb_stok.id_barang = tb_barang.id_barang
        ".$where."
        ORDER BY tb_transaksi.tanggal DESC
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
        <link rel="stylesheet" href="../../css/select2.min.css">
        <link rel="stylesheet" href="../../DataTables/datatables.min.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

        <script src="../../js/sweetalert2@11.js"></script>
        <script type="text/javascript">
            function selectFilter(e, filter) {
                let value = e.value;
                if (filter == "month") {
                    // console.log("./select-year.php?select-month=" + value);
                    window.location.href = "./select-filter.php?select-month=" + value;
                } else if (filter == "year") {
                    // console.log("./select-year.php?select-year=" + value);
                    window.location.href = "./select-filter.php?select-year=" + value;
                }
            }
        </script>

        <title>Staff | Stormz</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include("./sidebar-data-transaksi.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar -->
                    <?php include("./navbar-data-transaksi.php"); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary">Data Transaksi</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col">
                                        Filter
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-2">
                                        <select class="js-select2-month" style="width: 100%;" id="select-month" onchange="selectFilter(this, 'month');">
                                            <option value="" readonly></option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <select class="js-select2-year" style="width: 100%;" id="select-year" onchange="selectFilter(this, 'year');">
                                            <option value="" readonly></option>
                                            <?php 
                                            foreach ($data_year as $result) { 
                                                $year[] = idate('Y', strtotime($result['tanggal']));
                                            }
                                            $year = array_unique($year);
                                            foreach ($year as $result) {
                                            ?>
                                                <option value="<?= $result; ?>"
                                                <?php 
                                                if ($result == $select_year) echo "selected";
                                                ?>
                                                ><?= $result; ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary" id="show-all">Tampilkan Semua</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-danger mr-2" id="ex-pdf">Export PDF</button>
                                        <button type="button" class="btn btn-success" id="ex-excel">Export Excel</button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-data-trans" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Id Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Penanggung Jawab</th>
                                                <th>Tipe</th>
                                                <th>Jumlah</th>
                                                <th>Stok Akhir</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1; 
                                            foreach ($data as $result) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $result['id_transaksi']; ?></td>
                                                <td><?= $result['tanggal']; ?></td>
                                                <td><?= strtoupper($result['username']); ?></td>
                                                <td><?= $result['tipe']; ?></td>
                                                <td class="text-center"><?= $result['jumlah']; ?></td>
                                                <td class="text-center"><?= $result['jumlah_akhir']; ?></td>
                                                <td class="text-center"><?= $result['status']; ?></td>
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
                <?php include("./footer-data-transaksi.php"); ?>

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

        <!-- Page level plugins -->
        <script src="../../js/Chart.min.js"></script>

        <script src="../../js/select2.min.js"></script>
        <script src="../../DataTables/datatables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#table-data-trans').dataTable();
                $('.js-select2-month').select2({
                    placeholder: "Pilih Bulan"
                });
                $('.js-select2-year').select2({
                    placeholder: "Pilih Tahun"
                });
            });

            let month = <?= $select_month; ?>;
            if(month){
                const option = document.getElementById('select-month').options[month];
                option.setAttribute('selected', true);
                // console.log(option);
            }

            let btnExPdf = document.querySelector('#ex-pdf');
            let btnExExcel = document.querySelector('#ex-excel');
            let btnSelectAll = document.querySelector('#show-all');
            btnSelectAll.addEventListener("click", function() {
                document.location.href = "./select-filter.php?show-all=1";
            });

            btnExPdf.addEventListener("click", function() {
                // window.open('./pdf/print-pdf.php', '_blank');
                document.location.href = "./pdf/print-pdf.php";
            });
            btnExExcel.addEventListener("click", function() {
                // window.open('./pdf/print-pdf.php', '_blank');
                document.location.href = "./excel/print-excel.php";
            });


            // $('#select-month').change(selectMonth);
            // $('#select-year').change(selectYear);
        </script>
    </body>
</html>