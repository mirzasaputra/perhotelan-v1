<?php
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = 'Terjadi Kesalahan';

//mengambil nilai variabel
$id_transaksi = 'ID' . rand(0, 999999);
$no_invoice = $_POST['no_invoice'];
$id_tamu = $_POST['id_tamu'];
$id_kamar = $_POST['id_kamar'];
$jumlah_dewasa = $_POST['jumlah_dewasa'];
$jumlah_anak = $_POST['jumlah_anak'];
$tgl_chekin = $_POST['tgl_chek_in'];
$waktu_chekin = $_POST['waktu_chek_in'];
$tgl_chekout = $_POST['tgl_chek_out'];
$waktu_chekout = $_POST['waktu_chek_out'];
$deposit = $_POST['deposit'];
$tgl = date('Y-m-d');

//penghitungan
$harga_per_mlm = $_POST['harga_per_mlm'];
$in = date_create($tgl_chekin);
$out = date_create($tgl_chekout);
$inap = date_diff($in, $out)->format('%a');

if($inap == 0){
    $inap = 1;
}

$total_biaya = $inap * $harga_per_mlm;

if($inap < 1){
    $data['hasil'] = false;
    $data['pesan'] = 'Date Check Out Invalid';
} else {
    if(mysqli_query($conn, "UPDATE kamar SET status='Terpakai' WHERE id_kamar='$id_kamar'")){
        $query = mysqli_query($conn, "INSERT INTO transaksi_kamar VALUES ('$id_transaksi', '$no_invoice', '$tgl', '$id_tamu', '$id_kamar', '$jumlah_dewasa', '$jumlah_anak', '$tgl_chekin', '$waktu_chekin', '$tgl_chekout', '$waktu_chekout', '$total_biaya', '', 0,'$deposit', '', '', 'check in')");
        if($query){
            $data['hasil'] = true;
            $data['pesan'] = 'Transaction Success';
        } else {
            $data['hasil'] = false;
            $data['pesan'] = mysqli_error($conn);
        }
    } else {
        $data['hasil'] = false;
        $data['pesan'] = mysqli_error($conn);
    }
}

echo json_encode($data);