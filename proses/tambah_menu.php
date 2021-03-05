<?php
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = "An error";

//mengambil nilai variabel yang terkirim
$nama_menu = $_POST['nama_menu'];
$harga_menu = $_POST['harga_menu'];
$kategori = $_POST['kategori'];

//gambar
$gambar = $_FILES['gambar_menu']['name'];
$lokasi = $_FILES['gambar_menu']['tmp_name'];
$extensi = explode('.', $gambar);
$extensi = strtolower(end($extensi));
$extensiValid = ['jpg', 'jpeg', 'png'];
$namagambar = "Menu_";
$namagambar .= rand(0, 99999999);
$namagambar .= '_' . rand(0, 99999999) . '.';
$namagambar .= $extensi;

if($extensi == $extensiValid[0] | $extensi == $extensiValid[1] | $extensi == $extensiValid[2]){
    if(move_uploaded_file($lokasi, '../assets/img/menu/' . $namagambar)){
        $query = mysqli_query($conn, "INSERT INTO menu VALUES('', '$nama_menu', '$namagambar', '$harga_menu', '$kategori')");

        if($query){
            $data['hasil'] = true;
            $data['pesan'] = "Menu added";
        } else {
            $data['hasil'] = false;
            $data['pesan'] = "Connection lost";
        }
    }
} else {
    $data['hasil'] = false;
    $data['pesan'] = "Format Images invalid";
}


echo json_encode($data);