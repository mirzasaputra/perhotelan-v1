<?php

include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = "An error";

//mengambil nilai variabel
$id = $_GET['id'];
$nama = $_POST['nama_menu'];
$harga = $_POST['harga_menu'];
$kategori = $_POST['kategori'];

//gambar
if(!$_FILES['gambar_menu']['name'] == ''){
    $gambar = $_FILES['gambar_menu']['name'];
    $lokasi = $_FILES['gambar_menu']['tmp_name'];
    $extensi = explode('.', $gambar);
    $extensi = strtolower(end($extensi));
    $extensiValid = ['jpg', 'png', 'jpeg'];
    $namagambar = "Menu_";
    $namagambar .= rand(0, 99999999);
    $namagambar .= '_' . rand(0, 99999999) . '.';
    $namagambar .= $extensi;

    if($extensi == $extensiValid[0] | $extensi == $extensiValid[1] | $extensi == $extensiValid[2]){
        if(move_uploaded_file($lokasi, '../assets/img/menu/' . $namagambar)){
            $a=mysqli_query($conn, "SELECT * FROM menu WHERE id_menu='$id'");$b=mysqli_fetch_array($a);
        
            if(file_exists('../assets/img/menu/' . $b['img_menu'])){
                unlink('../assets/img/menu/' . $b['img_menu']);
        
                $query = mysqli_query($conn, "UPDATE menu SET nama_menu='$nama', harga_menu='$harga', kategori='$kategori', img_menu='$namagambar' WHERE id_menu='$id'");
                if($query){
                    $data['hasil'] = true;
                    $data['pesan'] = "Update success";
                } else {
                    $data['hasil'] = false;
                    $data['pesan'] = mysqli_error($conn);
                }
            }
        }
    } else {
        $data['hasil'] = false;
        $data['pesan'] = "Format image invalid";
    }
} else {
    $query = mysqli_query($conn, "UPDATE menu SET nama_menu='$nama', harga_menu='$harga', kategori='$kategori' WHERE id_menu='$id'");
        if($query){
            $data['hasil'] = true;
            $data['pesan'] = "Update success";
        } else {
            $data['hasil'] = false;
            $data['pesan'] = "Conection lost, please try again";
        }
}

echo json_encode($data);