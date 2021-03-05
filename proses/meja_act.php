<?php
include "../config/database.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$kd_meja = $_POST['no_meja'];
$status = $_POST['status'];

if(isset($_GET['tambah'])){
    $query = mysqli_query($conn, "INSERT INTO meja VALUES('', '$kd_meja', '$status')");
}
if(isset($_GET['ubah'])){
    $query = mysqli_query($conn, "UPDATE meja SET kd_meja='$kd_meja', status='$status' WHERE id_meja='$id'");
}

if($query){
    $data['hasil'] = true;
    $data['pesan'] = 'Success';
} else {
    $data['hasil'] = false;
    $data['pesan'] = 'Connection lost, please try again';
}


echo json_encode($data);