<?php
session_start();

//load_database
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = "Terjadi Kesalahan";

//mengambil nilai variabel
$tipe_kamar = $_POST['tipe_kamar'];
$harga_per_mlm = $_POST['harga_per_mlm'];
$harga_per_org = $_POST['harga_per_org'];

//chek tipe kamar
$query = mysqli_query($conn, "SELECT * FROM tipe_kamar WHERE tipe_kamar='$tipe_kamar'");
if(mysqli_num_rows($query)<=0){

    //query ke database
    $query = mysqli_query($conn, "INSERT INTO tipe_kamar VALUES('', '$tipe_kamar', '$harga_per_mlm', '$harga_per_org')");

    //membuat kondisi jika gagal maka menampilkan pesan error
    if($query){
        $data['hasil'] = true;
        $data['pesan'] = "Data Added";
    } else {
        $data['hasil'] = false;
        $data['pesan'] = "An error occurred while saving";
    }
} else {
    $data['hasil'] = false;
    $data['pesan'] = "Type Room is already";
}

echo json_encode($data);