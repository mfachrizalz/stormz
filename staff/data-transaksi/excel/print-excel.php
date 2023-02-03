<?php 
require_once("../../../functions/connection.php");
include_once("../../../functions/functions.php");

redirect_session(3, "staff");
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

if ($select_month == 0 && $select_year == 0) {
    $filename = "Data Semua Transaksi.xls";
} else {
    $filename = "Data Transaksi " . $arr_month[$select_month - 1] . " " . $select_year . ".xls";
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=" . $filename);

require_once("../../../mpdf_v8.0.3-master/vendor/autoload.php");
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8', 'format' => 'A4',
    'defaultPageNumStyle' => '1'
]);
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
                padding: 5px;
            }

            h2 {
                margin-bottom: -2px;
            }

            .top {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="top">
                <h2>DATA TRANSAKSI</h2>
                <?php 
                if ($select_month == 0 && $select_year == 0) {
                ?>
                    <div>Waktu: <i>semua</i></div>
                <?php 
                } else {
                ?>
                    <div>Waktu: <?= $arr_month[$select_month-1]; ?> <?= $select_year; ?></div>
                <?php 
                } 
                ?>
            </div>
            <br>
            <div class="info">
                <div><b>Dicetak oleh: </b></div>
                <div><?= $result_profile['nama_lengkap']; ?></div>
                <div><?= $result_profile['perusahaan']; ?></div>
            </div>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
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
    </body>
</html>