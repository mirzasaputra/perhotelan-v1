<?php
include "../config/database.php";
date_default_timezone_set('asia/jakarta');

$data['hasil'] = false;
$data['pesan'] = 'Terjadi Kesalahan';

if(isset($_GET['delete'])){
    $id = $_GET['id'];

    $query = mysqli_query($conn, "DELETE FROM booking WHERE id_booking='$id'");
    mysqli_query($conn, "DELETE FROM booking_detail WHERE id_booking='$id'");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Item has been deleted';
    }
} else {
    //mengambil data
    $id = $_POST['id_booking'];
    $id_tamu = $_POST['tamu_id'];
    $tgl = date('Y-m-d');
    $tgl_check_in = $_POST['tgl_chek_in'];
    $waktu_check_in = $_POST['waktu_chek_in'];
    $tgl_check_out = $_POST['tgl_chek_out'];
    $waktu_check_out = $_POST['waktu_chek_out'];
    $deposit = $_POST['deposit'];
    $metode = $_POST['metode'];
    $status = 1;
    
    $check = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking='$id'");
    
    if(mysqli_num_rows($check) > 0){
        //update
        $query = mysqli_query($conn, "UPDATE booking SET id_tamu='$id_tamu', tgl_booking='$tgl', tgl_check_in='$tgl_check_in', waktu_check_in='$waktu_check_in', tgl_checkout='$tgl_check_out', waktu_checkout='$waktu_check_out', deposit='$deposit', metode_pembayaran='$metode' WHERE id_booking='$id'");
    } else {
        //save
        $query = mysqli_query($conn, "INSERT INTO booking VALUES('$id', '$id_tamu', '$tgl', '$tgl_check_in', '$waktu_check_in', '$tgl_check_out', '$waktu_check_out', '$deposit', '$metode', '$status')");
    }
    
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Booking Success';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

echo json_encode($data);