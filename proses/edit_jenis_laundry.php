<?php
include "../config/database.php";

$men = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='gentlemen'");
$p = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='ladies'");
$child = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='children'");

$gentlemen = array();
foreach($men as $men) : 
    $gentlemen[$men['nama']] = $_POST['gentlemen_' . $men['id_jenis_laundry']];
    mysqli_query($conn, "UPDATE jenis_laundry SET harga='" . $gentlemen[$men['nama']] . "' WHERE nama='" . $men['nama'] . "' && type='gentlemen'");
endforeach;

$ladies = array();
foreach($p as $p) : 
    $ladies[$p['nama']] = $_POST['ladies_' . $p['id_jenis_laundry']];
    mysqli_query($conn, "UPDATE jenis_laundry SET harga='" . $ladies[$p['nama']] . "' WHERE nama='" . $p['nama'] . "' && type='ladies'");
endforeach;

$children = array();
foreach($child as $child) : 
    $children[$child['nama']] = $_POST['child_' . $child['id_jenis_laundry']];
    mysqli_query($conn, "UPDATE jenis_laundry SET harga='" . $children[$child['nama']] . "' WHERE nama='" . $child['nama'] . "' && type='children'");
endforeach;

if(empty(mysqli_error($conn))){
    $data['hasil'] = true;
    $data['pesan'] = 'Success';
} else {
    $data['hasil'] = false;
    $data['pesan'] = mysqli_error($conn);
}

echo json_encode($data);