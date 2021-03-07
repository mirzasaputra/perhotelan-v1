<?php
include "../../../config/database.php";

$id = $_GET['id'];

if(isset($_GET['menu'])){
    $query = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu='$id'");
    $data = mysqli_fetch_array($query);
}
if(isset($_GET['meja'])){
    $query = mysqli_query($conn, "SELECT * FROM meja WHERE id_meja='$id'");
    $data = mysqli_fetch_array($query);
}
if(isset($_GET['petugas'])){
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
    $data = mysqli_fetch_array($query);
}
if(isset($_GET['pesanan'])){
    $query = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu='$id'");
    $data = mysqli_fetch_array($query);
}

echo json_encode($data);