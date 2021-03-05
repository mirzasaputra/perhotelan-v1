<?php
session_start();
include "../config/database.php";

$data['hasil'] = false;
$data['pesan'] = 'An error';

if($_GET['act'] == 'add'){
    $cek = mysqli_query($conn, "SELECT * FROM laundry ORDER BY id_laundry DESC");
    $i = mysqli_fetch_array($cek);
    $id_laundry = $i['id_laundry'] + 1;
    $id_kamar = $_POST['id_kamar'];
    $waktu = $_POST['waktu'];
    $tanggal = $_POST['tanggal'];
    $type = $_POST['type'];

    $query = mysqli_query($conn, "INSERT INTO laundry VALUES('$id_laundry', '$id_kamar', '$waktu', '$tanggal', '$type', '', 'Input Laundry')");
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'success';
        $_SESSION['id_laundry'] = $id_laundry;
        $_SESSION['type'] = $type;
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if($_GET['act'] == "input"){
    $id_laundry = $_POST['id_laundry'];
    $id_jenis_laundry = $_POST['id_jenis_laundry'];
    $article = $_POST['nama'];
    $qty = $_POST['qty'];

    $query = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE id_jenis_laundry='$id_jenis_laundry'");
    $i = mysqli_fetch_array($query);
    $harga = $i['harga'];

    $total = $harga * $qty;

    $query = mysqli_query($conn, "INSERT INTO laundry_detail VALUES(null, '$id_laundry', '$id_jenis_laundry', '$article', '$qty', '$total')");
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'success';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if($_GET['act'] == 'delete'){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM laundry_detail WHERE id_laundry_detail = '$id'");
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'success';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if($_GET['act'] == 'confirm'){
    $id = $_POST['id_laundry'];
    $total = $_POST['total'];
    $query = mysqli_query($conn, "UPDATE laundry SET total='$total', status='Processing' WHERE id_laundry='$id'");
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Laundry is being processed, please wait';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if($_GET['act'] == 'confirm_laundry'){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "UPDATE laundry SET status='Menunggu pembayaran' WHERE id_laundry='$id'");
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Laundry has been confirm, waiting payment';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if($_GET['act'] == 'pembayaran'){
    date_default_timezone_set('asia/jakarta');
    $date = new DateTime('now');
    $waktu = $date->format('H:i');
    $tgl = $date->format('Y-m-d');
    $id = $_POST['id'];
    $bayar = $_POST['bayar'];
    $total = $_POST['total'];

    if($bayar >= $total){
       
        $query = mysqli_query($conn, "INSERT INTO transaksi_laundry VALUES(null, '$id', '$waktu', '$tgl', '$total', '$bayar')");
        
        if($query){
            mysqli_query($conn, "UPDATE laundry SET status='selesai' WHERE id_laundry='$id'");
            $data['hasil'] = true;
            $data['pesan'] = 'Transaction Success';
        } else {
            $data['pesan'] = mysqli_error($conn);
        }
    } else {
        $data['pesan'] = 'No enough payment amount';
    }

}
    
echo json_encode($data);