<?php
//load database
include '../config/database.php';

//mengambil nilai variabel
$nama_user = $_POST['nama_user'];
$username = $_POST['user'];
$password = md5($_POST['pass']);
$level = $_POST['level'];
$no_telp = $_POST['no_telp'];

//read image
if(empty($_FILES['image']['name'])){
    $namagambar = 'default.jpg';
} else {
    $gambar = $_FILES['image']['name'];
    $lokasi = $_FILES['image']['tmp_name'];
    $extensi = explode('.', $gambar);
    $extensi = strtolower(end($extensi));
    $extensiValid = ['jpeg', 'png', 'jpg'];
    $namagambar = 'User_';
    $namagambar .= rand(0, 999999);
     $namagambar .= '_'.rand(0, 999999);
    $namagambar .= '.'.$extensi;
}

//chek username
$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

if(mysqli_num_rows($query) > 0){
    $user = false;
}
elseif($namagambar == 'default.jpg'){
    $query = mysqli_query($conn, "INSERT INTO user VALUES('', '$nama_user', '$namagambar', '$username', '$password', '$level', '$no_telp', 'petugas hotel')");
} else {
    if($extensi == $extensiValid[0] OR $extensi == $extensiValid[1] OR $extensi == $extensiValid[2]){
        if(move_uploaded_file($lokasi, '../assets/img/'.$namagambar)){
            $query = mysqli_query($conn, "INSERT INTO user VALUES('', '$nama_user', '$namagambar', '$username', '$password', '$level', '$no_telp', 'petugas hotel')");
        }
    }
    else {
        $data['hasil'] = false;
        $data['pesan'] = 'Format Image invalid!!!';
    }
}

if(isset($user)){
    $data['hasil'] = false;
    $data['pesan'] = 'Username already registered';
}
elseif($query){
    $data['hasil'] = true;
    $data['pesan'] = 'Data added';
} 
else {
    $data['hasil'] = false;
    $data['pesan'] = 'An error';
}


echo json_encode($data);