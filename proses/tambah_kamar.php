<?php
//load database
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = 'Terjadi Kesalahan';

//mengambil nilai variabel
$no_kamar = $_POST['no_kamar'];
$tipe_kamar = $_POST['tipe_kamar'];
$max_dewasa = $_POST['max_dewasa'];
$max_anak = $_POST['max_anak'];
$status = 'Tersedia';

//chek kamar
$query = mysqli_query($conn, "SELECT * FROM kamar WHERE no_kamar='$no_kamar'");
if(mysqli_num_rows($query)<=0){
    //query ke database
    $query = mysqli_query($conn, "INSERT INTO kamar VALUES('', '$no_kamar', '$tipe_kamar', '$max_dewasa', '$max_anak', '$status')");
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Data added';
    }
} else {
    $data['hasil'] = false;
    $data['pesan'] = 'No. Room is already';
}

echo json_encode($data);