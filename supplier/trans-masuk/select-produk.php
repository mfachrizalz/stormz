<?php 
require("../../functions/connection.php");

if (isset($_POST['select_produk'])) {
    $id_barang = $_POST['select_produk'];

    $return_arr = array();
    $data_barang = mysqli_query($conn, "SELECT * FROM tb_barang 
                            INNER JOIN tb_merk
                            ON tb_barang.id_merk = tb_merk.id_merk
                            WHERE id_barang = '$id_barang'");

    $data_kategori = mysqli_query($conn, "SELECT * FROM tb_kategori_barang 
                            INNER JOIN  tb_kategori 
                            ON tb_kategori.id_kategori = tb_kategori_barang.id_kategori 
                            WHERE tb_kategori_barang.id_barang = '$id_barang'");

    $data_stok = mysqli_query($conn, "SELECT stok FROM tb_stok WHERE id_barang = '$id_barang'");
    $result_stok = mysqli_fetch_assoc($data_stok);

    while ($result = mysqli_fetch_assoc($data_barang)) {
        $id_barang = $result['id_barang'];
        $tipe = $result['tipe'];
        $harga = $result['harga'];
        $foto = $result['foto'];
        $merk = $result['merk'];
        $stok = $result_stok['stok'];

        $kategori = array();
        while ($result_kategori = mysqli_fetch_assoc($data_kategori)) {
            $kategori[] = $result_kategori['kategori'];
        }

        $return_arr[] = array(
                        "id_barang" => $id_barang,
                        "tipe" => $tipe,
                        "harga" => $harga,
                        "merk" => $merk,
                        "kategori" => $kategori,
                        "stok" => $stok,
                        "foto" => $foto
                    );
    }

    echo json_encode($return_arr);
    // echo '<label for="id-barang">ID Barang</label>';
    // echo '<input type="text" name="id-barang" value="'.$id_barang.'" class="form-control" readonly="readonly"/>';
}
?>