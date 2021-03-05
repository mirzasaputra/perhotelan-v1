<?php
include "../config/database.php";

if($_GET['act'] == 'surcharge'){
 
    $id = $_POST['id'];
    $surcharge = $_POST['surcharge'];

    $query = mysqli_query($conn, "UPDATE transaksi_kamar SET surcharge='$surcharge' WHERE id_transaksi_kamar='$id'");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = 'Surcharge added';
    } else {
        $data['hasil'] = false;
        $data['pesan'] = mysqli_error($conn);
    }

}

if($_GET['act'] == 'chek_out'){
    
    $id_transaksi = $_POST['id_transaksi_kamar'];
    $kamar = $_POST['id_kamar'];
    $diskon = $_POST['diskon'];

    if(empty($_POST['bayar'])){
        $bayar = '';
        $total = $_POST['total'];
    } else {
        $total = $_POST['total'];
        $bayar = $_POST['bayar'];
    }

    if($bayar >= $total){
        
        date_default_timezone_set('asia/jakarta');
        $date = new DateTime();
        $waktu = $date->format('H:i');
        $tgl = $date->format('Y-m-d');

        $query = mysqli_query($conn, "UPDATE transaksi_kamar SET bayar='$bayar', diskon='$diskon', status='check out' WHERE id_transaksi_kamar='$id_transaksi'");
        
        if($query){
            mysqli_query($conn, "UPDATE kamar SET status='kotor' WHERE id_kamar='$kamar'");
            $data['hasil'] = true;
            $data['pesan'] = 'Transaction Success';
        } else {
            $data['hasil'] = false;
            $data['pesan'] = mysqli_error($conn);
        }

        $query = mysqli_query($conn, "SELECT * FROM laundry WHERE id_kamar='$kamar' && status='Menunggu Pembayaran'");
        
        if(mysqli_num_rows($query) > 0){
            foreach($query as $i) :
                $totalLaundry = $i['total'];
                $id_laundry = $i['id_laundry'];
    
                mysqli_query($conn, "INSERT INTO transaksi_laundry VALUES('', '$id_laundry', '$waktu', '$tgl', '$total', '0')");
                mysqli_query($conn, "UPDATE laundry SET status='selesai' WHERE id_laundry='$id_laundry'");
            endforeach;
        }
        
        $query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_transaksi_kamar='$id_transaksi' && status='Menunggu Pembayaran'");
        
        if(mysqli_num_rows($query) > 0){
            foreach($query as $i) :
                $id_pesanan = $i['id_pesanan'];
                $total = $i['total'];

                mysqli_query($conn, "INSERT INTO transaksi_resto VALUES('', '$id_pesanan', '$total', '0', '$waktu', '$tgl')");
                mysqli_query($conn, "UPDATE pesanan SET status='selesai' WHERE id_pesanan='$id_pesanan'");
            endforeach;
        }

        echo mysqli_error($conn);
    } else {
        $data['hasil'] = false;
        $data['pesan'] = 'Not enough payment amount';
    }

}


echo json_encode($data);