<?php
session_start();
include "../config/database.php";

date_default_timezone_set('asia/jakarta');
$date = new DateTime();
$dateNow = $date->format('Y-m-d');
$waktu = $date->format('H:i');

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = 'An error';

if(isset($_GET['tambah_pelanggan'])){
    //mengambil nilai variabel yang terkirim
    $id_pesanan = 'ID' . rand(0, 99999999);
    if(isset($_POST['id_meja'])){
        $id_meja = $_POST['id_meja'];
        $id_transaksi = $_POST['id_transaksi'];
    } else {
        $id_transaksi = $_GET['id_transaksi'];
    }
    

    if(empty($id_meja)){
        $query = mysqli_query($conn, "INSERT INTO pesanan VALUES('$id_pesanan', '$id_transaksi', '', '', '$waktu', '$dateNow', 'Dari Kamar', 'Memilih Menu')");
        $_SESSION['url'] = "?module=tambah_pesanan";
    } else {
        if($id_meja !== "false" && $id_transaksi !== "false"){
            $query = mysqli_query($conn, "INSERT INTO pesanan VALUES('$id_pesanan', '$id_transaksi', '$id_meja', '', '$waktu', '$dateNow', 'Dari Resto', 'Memilih Menu')");
            mysqli_query($conn, "UPDATE meja SET status='Penuh' WHERE id_meja='$id_meja'");
            $_SESSION['url'] = "?module=restaurant/tambah_pesanan";
        }
    }

    if(isset($query) && $query){
        $data['hasil'] = true;
        $data['pesan'] = 'Success';
        $_SESSION['id_pesanan'] = $id_pesanan;
    } else {
        if(isset($id_transaksi)){
            $data['pesan'] = "Please select guest";
        } elseif(isset($id_meja)){
            $data['pesan'] = "please select no table";
        } else {
            $data['pesan'] = mysqli_error($conn);
        }
    }
    
}
if(isset($_GET['pesanan'])){
    //mengambi nilai variabel
    $id_menu = $_GET['id'];
    $id_pesanan = $_SESSION['id_pesanan'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $total = $harga * $qty;

    //query ke database
    $query = mysqli_query($conn, "INSERT INTO pesanan_detail VALUES(null, '$id_pesanan', '$id_menu', '$qty', '$total')");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = "";
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

echo json_encode($data);