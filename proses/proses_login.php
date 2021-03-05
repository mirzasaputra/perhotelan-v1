<?php
session_start();
include "../config/database.php";

//menampilkan pesan error
$data["hasil"] = false;
$data["pesan"] = "Terjadi kesalahan";

//mengambil nilai variabel yang terkirim
$user = $_POST["username"];
$pass = md5($_POST["password"]);

//jika ada variabel yang kosong
if(empty($user)){
    $data["hasil"] = false;
    $data["pesan"] = "Username must be filled";
}
elseif(empty($_POST['password'])){
    $data["hasil"] = false;
    $data["pesan"] = "Password cannot be empty";
}
else{

//melakukan query ke database
$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$user'");
$cek = mysqli_num_rows($query);
if($cek > 0){
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' && password='$pass'");
    $cek = mysqli_num_rows($query);
    $i = mysqli_fetch_array($query);
    if($cek > 0){
        $data["hasil"] = true;
        $data["pesan"] = "Login Berhasil";
        $_SESSION["get"] = $i["level"];
        $_SESSION["user"] = $user;
        $_SESSION["pass"] = $pass;
    }
    else {
        $data['hasil'] = false;
        $data['pesan'] = "Password do not match";
    }
}
else {
    $data['hasil'] = false;
    $data['pesan'] = "Username not registered";
}
}

echo json_encode($data);