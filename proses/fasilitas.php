<?php
session_start();
//load database
include "../config/database.php";

$data['hasil'] = false;
$data['pesan'] = 'An Error';

if(isset($_GET['tambah'])){
    //mengambil data
    $name = $_POST['fasilitas'];

    //menjalankan query
    $query = mysqli_query($conn, "INSERT INTO fasilitas VALUES(null, '$name')");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Data telah ditambahkan';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if(isset($_GET['edit'])){
    //mengambil data
    $id = $_POST['id'];
    $fasilitas = $_POST['fasilitas'];
    
    //menjalankan query
    $query = mysqli_query($conn, "UPDATE fasilitas SET fasilitas_name='$fasilitas' WHERE id='$id'");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Data Successfully updated';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if(isset($_GET['delete'])){
    //mengambil id
    $id = $_GET['id'];

    //menjalankan query
    $query = mysqli_query($conn, "DELETE FROM fasilitas WHERE id='$id'");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Data successfuly deleted';
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

if(isset($_GET['session'])){
    $id = $_GET['id'];
    $fasilitas = $_POST['fasilitas'];

    $_SESSION['fasilitas_'. $id] = $fasilitas;
}

echo json_encode($data);