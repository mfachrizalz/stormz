<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['trans-in'])) {
    // 2022-12-19 12:46:40
    $username = $_SESSION['username'];
    $id_transaksi = $_POST['id-transaksi'];
    $datetime = date("Y-m-d H:i:s");
    $status = "IN";
    
    $query_transaksi = "INSERT INTO tb_transaksi(id_transaksi, username, tanggal, status)
                    VALUES ('$id_transaksi', '$username', '$datetime', '$status')
                    ";
    $result_transaksi = mysqli_query($conn, $query_transaksi);

    $data_temp = [];
    $data = mysqli_query($conn, "SELECT * FROM tb_transaksi_detail_temp WHERE status ='$status'");
    foreach ($data as $item) {
        $data_temp[] = $item;
    }

    foreach ($data_temp as $item) {
        $id_barang = $item['id_barang'];
        $jumlah = $item['jumlah'];
        $stok_akhir = $item['stok_akhir'];

        $query_stok = "SELECT * FROM tb_stok WHERE id_barang = '$id_barang'";
        $data_stok = mysqli_query($conn, $query_stok);
        $result_stok = mysqli_fetch_assoc($data_stok);
        $id_stok = $result_stok['id_stok'];

        $query_update_stok = "UPDATE tb_stok SET stok = '$stok_akhir' WHERE id_stok = '$id_stok'";
        $result_update_stok = mysqli_query($conn, $query_update_stok);

        $query_transaksi_detail = "INSERT INTO tb_transaksi_detail(id_transaksi_detail, id_transaksi, id_stok, jumlah, jumlah_akhir)
                                VALUES ('', '$id_transaksi', '$id_stok', '$jumlah', '$stok_akhir')
                                ";
        $result_transaksi_detail = mysqli_query($conn, $query_transaksi_detail);
    }

    mysqli_query($conn, "DELETE FROM tb_transaksi_detail_temp WHERE status = '$status'");

    if (!$result_transaksi || !$result_update_stok || !$result_transaksi_detail) {
        $_SESSION['trans-in-status'] = 2;
    }
    $_SESSION['trans-in-status'] = 1;

    header("location: ./");
    exit;
}
?>