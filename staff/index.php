<?php 
require_once("../functions/connection.php");
include_once("../functions/functions.php");

redirect_session(1, "staff");
$username = $_SESSION['username'];

$select_chart = @$_SESSION['select-chart'];

if (!isset($_SESSION['select-chart'])) {
    $select_chart = 0;
} 
$w_chart = "MONTH(tb_transaksi.tanggal) = " . $select_chart;

if ($select_chart == 0) {
    $where = "WHERE YEAR(tb_transaksi.tanggal) = " . date('Y');
} else {
    $where = "WHERE " . $w_chart . " AND YEAR(tb_transaksi.tanggal) = " . date('Y');
}

echo "
    <script>
        console.log('".$where."');
        console.log('session chart = ".$select_chart."');
    </script>
";

$query = "SELECT * FROM tb_transaksi
        ".$where."
        ORDER BY tb_transaksi.tanggal DESC
        ";
$data = mysqli_query($conn, $query);
foreach ($data as $result) {
    $tanggal = date('m', strtotime($result['tanggal']));
    // echo $tanggal . "<br>";
    
}
// exit;

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

$result_barang = mysqli_query($conn, "SELECT * FROM tb_barang");
$total_barang = mysqli_num_rows($result_barang);

$result_transaksi_masuk = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status = 'IN'");
$result_transaksi_keluar = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status = 'OUT'");
$total_transaksi_masuk = mysqli_num_rows($result_transaksi_masuk);
$total_transaksi_keluar = mysqli_num_rows($result_transaksi_keluar);

$result_supp = mysqli_query($conn, "SELECT * FROM tb_user WHERE role = 'supplier'");
$total_supp = mysqli_num_rows($result_supp);

$chart_kategoris = [];
$data_kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
foreach ($data_kategori as $result_kategori) {
    $id_kategori = $result_kategori['id_kategori'];
    $kategori_barang = mysqli_query($conn, "SELECT * FROM tb_kategori_barang WHERE id_kategori = '$id_kategori'");
    $kategori_barang = mysqli_num_rows($kategori_barang);
    $chart_kategoris[] = [
        'kategori' => $result_kategori['kategori'],
        'total' => $kategori_barang
    ];
    // echo $chart_kategoris['kategori'];
}

$chart_pie_bg_color = ['#021531', '#EC971C', '#325d79', '#14de5b'];
$chart_pie_hover = ['#0855C9', '#F0B665', '#1c3545', '#1cc88a'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../css/select2.min.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Staff | Stormz</title>

    <script>
        function selectChart(e) {
                let value = e.value;
                window.location.href = "./select-chart.php?select-chart=" + value;
            }
    </script>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("./sidebar-staff.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                <?php include("./navbar-staff.php"); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Card Total Produk -->
                        <div class="col col-md-4 mb-4">
                            <a href="./data-produk/" style="text-decoration: none;">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Produk</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $total_barang; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
                                                    <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Card Total Transaksi -->
                        <div class="col col-md-4 mb-4">
                            <a href="./data-transaksi/" style="text-decoration: none;">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Transaksi</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Masuk : <?= $total_transaksi_masuk; ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Keluar : <?= $total_transaksi_keluar; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-data-fill" viewBox="0 0 16 16">
                                                    <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                                                    <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5ZM10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Card Total User -->
                        <div class="col col-md-4 mb-4">
                            <a href="./kelola-user/" style="text-decoration: none;">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Supplier : <?= $total_supp; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <!-- <div class="row">
                        <div class="col-xl col-lg">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Record Transaksi</h6>
                                    <select class="js-select2-record-chart" id="select-chart" style="width: 30%" onchange="selectChart(this)">
                                        <option value="0">Tampilkan Semua</option>
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
                                
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="line-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Pie Chart  -->
                    <div class="row">
                        <div class="col-xl col-lg">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown  -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Kategori Barang</h6>
                                </div>
                                <!-- Card Body  -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="pie-chart"></canvas>
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
            <?php include("./footer-staff.php"); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../js/Chart.min.js"></script>

    <script src="../js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-select2-record-chart').select2({
                placeholder: "Pilih Rentang Record"
            });
        });

        let chart = <?= $select_chart; ?>;
        if(chart){
            const option = document.getElementById('select-chart').options[chart];
            option.setAttribute('selected', true);
            // console.log(option);
        }

        async function requestSelect() {
            let recordChart = $(this).val();

            const data = await $.ajax({
                type: 'POST',
                url: 'record-chart.php',
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

            $('#kategori').empty()
            for (let i = 0; i < result.kategori.length; i++) {
                $('#kategori').append('<option selected class="opt-kategori" value="' + result.kategori[i] + '">' + result.kategori[i] + '</option>');
            }
        }

        $('#select-produk').change(requestSelect);

        // CHART //
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

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

        // Area Chart Example
        // var lineChart = document.getElementById("line-chart");
        // var myLineChart = new Chart(lineChart, {
        //     type: 'line',
        //     data: {
        //         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //         datasets: [{
        //         label: "Earnings",
        //         lineTension: 0.3,
        //         backgroundColor: "rgba(78, 115, 223, 0.05)",
        //         borderColor: "rgba(78, 115, 223, 1)",
        //         pointRadius: 3,
        //         pointBackgroundColor: "rgba(78, 115, 223, 1)",
        //         pointBorderColor: "rgba(78, 115, 223, 1)",
        //         pointHoverRadius: 3,
        //         pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        //         pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        //         pointHitRadius: 10,
        //         pointBorderWidth: 2,
        //         data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
        //         }],
        //     },
        //     options: {
        //         maintainAspectRatio: false,
        //         layout: {
        //         padding: {
        //             left: 10,
        //             right: 25,
        //             top: 25,
        //             bottom: 0
        //         }
        //         },
        //         scales: {
        //         xAxes: [{
        //             time: {
        //             unit: 'date'
        //             },
        //             gridLines: {
        //             display: false,
        //             drawBorder: false
        //             },
        //             ticks: {
        //             maxTicksLimit: 7
        //             }
        //         }],
        //         yAxes: [{
        //             ticks: {
        //             maxTicksLimit: 5,
        //             padding: 10,
        //             // Include a dollar sign in the ticks
        //             callback: function(value, index, values) {
        //                 return '$' + number_format(value);
        //             }
        //             },
        //             gridLines: {
        //             color: "rgb(234, 236, 244)",
        //             zeroLineColor: "rgb(234, 236, 244)",
        //             drawBorder: false,
        //             borderDash: [2],
        //             zeroLineBorderDash: [2]
        //             }
        //         }],
        //         },
        //         legend: {
        //         display: false
        //         },
        //         tooltips: {
        //         backgroundColor: "rgb(255,255,255)",
        //         bodyFontColor: "#858796",
        //         titleMarginBottom: 10,
        //         titleFontColor: '#6e707e',
        //         titleFontSize: 14,
        //         borderColor: '#dddfeb',
        //         borderWidth: 1,
        //         xPadding: 15,
        //         yPadding: 15,
        //         displayColors: false,
        //         intersect: false,
        //         mode: 'index',
        //         caretPadding: 10,
        //         callbacks: {
        //             label: function(tooltipItem, chart) {
        //             var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
        //             return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        //             }
        //         }
        //         }
        //     }
        // });

        var pieChart = document.getElementById("pie-chart");
        var myPieChart = new Chart(pieChart, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                    foreach ($chart_kategoris as $chart_kategori) {
                        echo '"' . ucwords($chart_kategori['kategori']) . '", ';
                    }
                    ?>
                ],
                datasets: [{
                data: [
                    <?php
                    foreach ($chart_kategoris as $chart_kategori) {
                        echo $chart_kategori['total'] . ', ';
                    }
                    ?>
                ],
                backgroundColor: [
                    <?php
                    $no = 0;
                    foreach ($chart_kategoris as $chart_kategori) {
                        if ($no == count($chart_pie_bg_color)) {
                            $no = 0;
                        }
                        echo '"' . $chart_pie_bg_color[$no] . '", ';
                        $no++;
                    }
                    ?>
                ],
                hoverBackgroundColor: [
                    <?php
                    $no = 0;
                    foreach ($chart_kategoris as $chart_kategori) {
                        if ($no == count($chart_pie_bg_color)) {
                            $no = 0;
                        }
                        echo '"' . $chart_pie_hover[$no] . '", ';
                        $no++;
                    }
                    ?>
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                },
                legend: {
                display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>

</body>
</html>