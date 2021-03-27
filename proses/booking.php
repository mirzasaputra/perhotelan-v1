<?php
include "../config/database.php";
date_default_timezone_set('asia/jakarta');

$data['hasil'] = false;
$data['pesan'] = 'Terjadi Kesalahan';

//mengambil data
$id = $_POST['id_booking'];
$id_tamu = $_POST['tamu_id'];
$tgl = date('Y-m-d');
$tgl_check_in = $_POST['tgl_chek_in'];
$waktu_check_in = $_POST['waktu_chek_in'];
$tgl_check_out = $_POST['tgl_chek_out'];
$waktu_check_out = $_POST['waktu_chek_out'];
$status = 1;

//save
$query = mysqli_query($conn, "INSERT INTO booking VALUES('$id', '$id_tamu', '$tgl', '$tgl_check_in', '$waktu_check_in', '$tgl_check_out', '$waktu_check_out', '$status')");

if($query){
    $data['hasil'] = true;
    $data['pesan'] = 'Booking Success';
} else {
    $data['pesan'] = mysqli_error($conn);
}

echo json_encode($data);