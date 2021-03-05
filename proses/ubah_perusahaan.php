<?php
include '../config/database.php';

$data['hasil'] = false;
$data['pesan'] = 'Terjadi Kesalahan';

//mengambil nilai variabel
$id = $_POST['id'];
$nama_hotel = $_POST['nama_hotel'];
$nama_perusahaan = $_POST['nama_perusahaan'];
$jalan = $_POST['jalan'];
$no_jalan = $_POST['no_jalan'];
$kecamatan = $_POST['kecamatan'];
$kabupaten = $_POST['kabupaten'];
$no_telp = $_POST['no_telp'];
$no_fax = $_POST['no_fax'];
$website = $_POST['website'];
$email = $_POST['email'];

//query ke database
$query = mysqli_query($conn, "UPDATE perusahaan SET nama_hotel='$nama_hotel',
                                                    nama_perusahaan='$nama_perusahaan',
                                                    jalan='$jalan',
                                                    no_jalan='$no_jalan',
                                                    kecamatan='$kecamatan',
                                                    kabupaten='$kabupaten',
                                                    no_telp='$no_telp',
                                                    no_fax='$no_fax',
                                                    website='$website',
                                                    email='$email'
                                WHERE id_perusahaan='$id'");

if($query){
    $data['hasil'] = true;
    $data['pesan'] = 'Data has been updated';
} else {
    $data['hasil'] = false;
    $data['pesan'] = 'Failed to update data';
}

echo json_encode($data);