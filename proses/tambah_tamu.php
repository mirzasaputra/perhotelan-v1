<?php
//load database
include "../config/database.php";

$data['hasil'] = false;
$data['pesan'] = 'An error';

//mengambil nilai variabel yang terkirim
$prefix = $_POST['prefix'];
$nama_depan = $_POST['nama_depan'];
$nama_blkg = $_POST['nama_blkg'];
$tipe_identitas = $_POST['tipe_identitas'];
$no_identitas = $_POST['no_identitas'];
$warga_negara = $_POST['warga_negara'];
$jalan = $_POST['jalan'];
$no_jalan = $_POST['no_jalan'];
$kabupaten = $_POST['kabupaten'];
$provinsi = $_POST['provinsi'];
$no_telp = $_POST['no_telp'];

//pembuatan id_tamu
$id_tamu = 'ID';
$id_tamu .= rand(0, 999999);

//query ke database
$query = mysqli_query($conn, "INSERT INTO tamu VALUES('$id_tamu', '$prefix', '$nama_depan', '$nama_blkg', '$tipe_identitas', '$no_identitas', '$warga_negara', '$jalan', '$no_jalan', '$kabupaten', '$provinsi', '$no_telp')");
if($query){
    $data['hasil'] = true;
    $data['pesan'] = 'Guest added';
} else {
    $data['hasil'] = false;
    $data['pesan'] = 'An Error';
}

echo json_encode($data);