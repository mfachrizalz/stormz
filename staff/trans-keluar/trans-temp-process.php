<?php 
require_once("../../functions/connection.php");
include_once("../../functions/functions.php");

redirect_session(2, "staff");
$username = $_SESSION['username'];

if (isset($_GET['delete'])) {
    $id_barang = $_GET['delete'];

    if ($id_barang) {
        mysqli_query($conn, "DELETE FROM tb_transaksi_detail_temp WHERE id_barang = '$id_barang' AND username = '$username'");
    }
    header("location: ./");
    exit;
}

if (isset($_POST['add-detail-produk'])) {
    $id_barang = $_POST['id-barang'];
    $tipe = $_POST['tipe'];
    $merk = $_POST['merk'];
    $jumlah_keluar = $_POST['jumlah-keluar'];
    $stok_akhir = $_POST['stok-akhir'];
    $status = "OUT";

    $query = "INSERT INTO tb_transaksi_detail_temp(id, id_barang, tipe, merk, jumlah, stok_akhir, status, username)
            VALUES ('', '$id_barang', '$tipe', '$merk', '$jumlah_keluar', '$stok_akhir', '$status', '$username')
            ";
    $data = mysqli_query($conn, $query);
    header("location: ./");
    exit;
}
?>