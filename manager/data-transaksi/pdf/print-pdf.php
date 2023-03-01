<?php 
require_once("../../../functions/connection.php");
include_once("../../../functions/functions.php");

redirect_session(3, "manager");
$username = $_SESSION['username'];

$arr_month = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

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

// echo "
//     <script>
//         console.log('".$where."');
//         console.log('session year = ".$select_year."');
//         console.log('session month = ".$select_month."');
//     </script>
// ";

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

$result_profile = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
$result_profile = mysqli_fetch_assoc($result_profile);

require_once("../../../mpdf_v8.0.3-master/vendor/autoload.php");
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8', 'format' => 'A4',
    'defaultPageNumStyle' => '1'
]);
ob_start();
// $mpdf->showImageErrors = true;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../../../css/style-pdf.css" media="all"/>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="../../../assets/img/logo-stormz.png" alt="logo" height="70">
            </div>
            <div id="company">
                <h2 class="name">STORMZ</h2>
                <div>SMK NEGERI 2 SURABAYA</div>
                <div>+62 87855736610</div>
                <div>
                    <a href="mailto:ptstormz.id@gmail.com" target="_blank">ptstormz.id@gmail.com</a>
                </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client"> 
                    <div class="print">DICETAK OLEH:</div> 
                    <h2 class="name"><?= ucwords($result_profile['nama_lengkap']); ?></h2> 
                    <div class="company"><?= ucwords($result_profile['perusahaan']) ?></div> 
                    <div class="email"><?= $result_profile['email']; ?></div>
                </div>
                <div id="invoice">
                    <h1>DATA TRANSAKSI</h1>
                    <?php 
                    if ($select_month == 0 && $select_year == 0) {
                    ?>
                        <div class="date">Waktu: <i>semua</i></div>
                    <?php 
                    } else {
                    ?>
                        <div class="date">Waktu: <?= $arr_month[$select_month-1]; ?> <?= $select_year; ?></div>
                    <?php 
                    } 
                    ?>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
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
                        <td><?= $no; ?></td>
                        <td><?= $result['id_transaksi']; ?></td>
                        <td><?= $result['tanggal']; ?></td>
                        <td><?= strtoupper($result['username']); ?></td>
                        <td><?= $result['tipe']; ?></td>
                        <td><?= $result['jumlah']; ?></td>
                        <td><?= $result['stok']; ?></td>
                        <td><?= $result['status']; ?></td>
                    </tr>
                    <?php 
            $no++;
            }
            ?>
                </tbody>
            </table>
        </main>
        <footer>
            &copy; STORMZ <?= date('Y'); ?>
        </footer>
    </body>
</html>

<?php 
if ($select_month == 0 && $select_year == 0) {
    $filename = "Data Semua Transaksi.pdf";
} else {
    $filename = "Data Transaksi " . $arr_month[$select_month - 1] . " " . $select_year . ".pdf";
}
$html = ob_get_contents();
$mpdf->WriteHTML($html);
ob_end_clean();
// $mpdf->debug = true;
$mpdf->Output($filename, 'D');
?>