<?php
include "../config/database.php";

date_default_timezone_set("asia/jakarta");
$date = new DateTime();
$tgl = $date->format('Y-m-d');
$waktu = $date->format('H:i');
$id = $_POST['id'];

if(isset($_POST['bayar'])){
    //mengambil data
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];

    if($bayar >= $total){
        $query = mysqli_query($conn, "INSERT INTO transaksi_resto VALUES('', '$id', '$total', '$bayar', '$waktu', '$tgl')");
        
        if($query){
            mysqli_query($conn, "UPDATE pesanan SET status='selesai' WHERE id_pesanan='$id'");
            $data['hasil'] = true;
            $data['pesan'] = "Transaction Success";
        } else {
            $data['hasil'] = false;
            $data['pesan'] = mysqli_error($conn);
        }
    } else {
        $data['hasil'] = false;
        $data['pesan'] = "Not enough payment amount";
    }

} else {
    $query = mysqli_query($conn, "UPDATE pesanan SET status='Menunggu pembayaran' WHERE id_pesanan='$id'");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = "Update Success";
    } else {
        $data['hasil'] = false;
        $data['pesan'] = "An error";
    }
}

echo json_encode($data);