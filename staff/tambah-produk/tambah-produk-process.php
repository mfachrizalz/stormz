<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['add-produk'])) {
    $tipe = strtoupper($_POST['tipe']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategoris = $_POST['kategori'];
    $merk = $_POST['merk'];

    $name_foto = $_FILES['foto']['name'];
    $extension_foto = explode('.', $name_foto);
    $extension_foto = strtolower(end($extension_foto));
    $rand_foto = uniqid();
    $send_foto = $rand_foto . "." . $extension_foto;
    $location = $_FILES['foto']['tmp_name'];
    $file_location = "../../assets/img/barang/";
    $upload_foto = move_uploaded_file($location, $file_location . $send_foto);

    if ($upload_foto) {
        $query_barang = "INSERT INTO tb_barang(id_barang, tipe, harga, foto, id_merk)
            VALUES ('', '$tipe', '$harga', '$send_foto', '$merk')
        ";
        $result_barang = mysqli_query($conn, $query_barang);

        $query_select_barang = "SELECT id_barang FROM tb_barang ORDER BY id_barang DESC";
        if ($result_barang) {
            $result_select_barang = mysqli_query($conn, $query_select_barang);
            $id_barangs = mysqli_fetch_assoc($result_select_barang);
            foreach($id_barangs as $id_barang) {
                $query_stok = "INSERT INTO tb_stok(id_stok, id_barang, stok) VALUES ('', '$id_barang', '$stok')";
                $result_stok = mysqli_query($conn, $query_stok);

                foreach($kategoris as $kategori) {
                    $query_kategori = "INSERT INTO tb_kategori_barang(id_kategori_barang, id_barang, id_kategori) VALUES ('', '$id_barang', '$kategori')";
                    $result_kategori = mysqli_query($conn, $query_kategori);
                }
            }
        }
    }

    if (!$upload_foto || !$result_barang || !$result_stok || !$result_kategori) {
        $_SESSION['add-produk-status'] = 2;
    }
    $_SESSION['add-produk-status'] = 1;

    header("location: ./");
    exit;
}
?>