<?php
session_start();

//load database
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = 'An error';

//mengambil nilai variabel
$id = $_GET['id'];

if($_GET['hapus']){
    //query ke database
    $read = mysqli_query($conn, "SELECT * FROM ". $_GET['hapus'] . " WHERE id_" . $_GET['hapus'] . "='$id'");
    $i = mysqli_fetch_array($read);
    
    if($_GET['hapus'] == "user"){
        if($i['image'] == "default.jpg"){
            $query = mysqli_query($conn, "DELETE FROM ".$_GET['hapus']." WHERE id_".$_GET['hapus']."='$id'");
        }
        else {
            if(file_exists('../assets/img/' . $i['image'])){
                unlink('../assets/img/' . $i['image']);
                            
                $query = mysqli_query($conn, "DELETE FROM ".$_GET['hapus']." WHERE id_".$_GET['hapus']."='$id'");
            }
        }
    } elseif ($_GET['hapus'] == "menu"){
        if(file_exists('../assets/img/menu/' . $i['img_menu'])){
            unlink('../assets/img/menu/' . $i['img_menu']);
        }

        $query = mysqli_query($conn, "DELETE FROM ".$_GET['hapus']." WHERE id_".$_GET['hapus']."='$id'");
    } else {
        $query = mysqli_query($conn, "DELETE FROM ".$_GET['hapus']." WHERE id_".$_GET['hapus']."='$id'");
    }
    
}



if($query){
    $data['hasil'] = true;
    $data['pesan'] = 'Data deleted';
} else {
    $data['hasil'] = false;
    $data['pesan'] = 'An error has been deleting';
}


echo json_encode($data);