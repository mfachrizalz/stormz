<?php 
require('../../functions/connection.php');
include "../../functions/functions.php";
session_start();

if (isset($_POST['edit-produk'])) {
    $id_barang = $_POST['id-produk'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategoris = $_POST['kategori'];
    $merk = $_POST['merk'];

    // foreach ($kategoris as $kategori) {
    //     echo($kategori);
    // }
    // exit;

    $name_foto = $_FILES['foto']['name'];
    $extension_foto = explode('.', $name_foto);
    $extension_foto = strtolower(end($extension_foto));
    $rand_foto = uniqid();
    $location = $_FILES['foto']['tmp_name'];
    $file_location = "../../assets/img/barang/";

    if ($_FILES['foto']['error'] == 4) {
        $send_foto = $_POST['foto-old'];

        $query_barang = "UPDATE tb_barang 
                    SET tipe = '$tipe', harga = '$harga', foto = '$send_foto', id_merk = '$merk'
                    WHERE id_barang = '$id_barang'
                    ";
        $result_barang = mysqli_query($conn, $query_barang);

        $query_stok = "UPDATE tb_stok
                    SET stok = '$stok'
                    WHERE id_barang = '$id_barang'
                    ";
        $result_stok = mysqli_query($conn, $query_stok);

        mysqli_query($conn, "DELETE FROM tb_kategori_barang WHERE id_barang = '$id_barang'");

        foreach ($kategoris as $kategori) {
            $query_kategori = "INSERT INTO tb_kategori_barang(id_kategori_barang, id_barang, id_kategori) 
                            VALUES ('', '$id_barang', '$kategori')
                            ";
            $result_kategori = mysqli_query($conn, $query_kategori);
        }
    } else {
        $send_foto = $rand_foto . "." . $extension_foto;
        $upload_foto = move_uploaded_file($location, $file_location . $send_foto);

        if ($upload_foto) {
            unlink($file_location . $_POST['foto-old']);
            $query_barang = "UPDATE tb_barang 
                SET tipe = '$tipe', harga = '$harga', foto = '$send_foto', id_merk = '$merk'
                WHERE id_barang = '$id_barang'
                ";
            $result_barang = mysqli_query($conn, $query_barang);

            $query_stok = "UPDATE tb_stok
                SET stok = '$stok'
                WHERE id_barang = '$id_barang'
                ";
            $result_stok = mysqli_query($conn, $query_stok);

            mysqli_query($conn, "DELETE FROM tb_kategori_barang WHERE id_barang = '$id_barang'");

            foreach ($kategoris as $kategori) {
                $query_kategori = "INSERT INTO tb_kategori_barang(id_kategori_barang, id_barang, id_kategori) 
                                VALUES ('', '$id_barang', '$kategori')
                                ";
                $result_kategori = mysqli_query($conn, $query_kategori);
            }
        }
    }

    if (!$upload_foto || !$result_barang || !$result_stok || !$result_kategori) {
        $_SESSION['edit-produk-status'] = 2;
    }
    $_SESSION['edit-produk-status'] = 1;

    header("location: ./index.php?edit=$id_barang");
    exit;
}
?>