<?php
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = "An error";

//menagmbil nilai variabel
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$nama = $_POST['nama'];
$username = $_POST['user'];
$password = md5($_POST['pass']);
if(isset($_POST['passLama'])){
    if($_POST['pass'] == $_POST['passLama']){
        $password = $_POST['passLama'];
    }
}
$level = $_POST['level'];
$no_telp = $_POST['no_telp'];
if(isset($_POST['gambarLama'])){
    $gambarLama = $_POST['gambarLama'];
}

//gambar
if($_FILES['image']['name'] !== ''){
    $gambar = $_FILES['image']['name'];
    $lokasi = $_FILES['image']['tmp_name'];
    $extensi = explode('.', $gambar);
    $extensi = strtolower(end($extensi));
    $extensiValid = ['jpg', 'png', 'jpeg'];
    $namagambar = 'User_';
    $namagambar .= rand(0, 99999999) . '_' . rand(0, 99999999) . '.';
    $namagambar .= $extensi;
} else {
    $namagambar = 'default.jpg';
}

if(isset($_GET['tambah'])){
    //cek username
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if(mysqli_num_rows($query) == 0){
        if($_FILES['image']['name'] !== ''){
            if($extensi == $extensiValid[0] | $extensi == $extensiValid[1] | $extensi == $extensiValid[2]){
                if(move_uploaded_file($lokasi, '../assets/img/' . $namagambar)){
                    $query = mysqli_query($conn, "INSERT INTO user VALUES('', '$nama', '$namagambar', '$username', '$password', '$level', '$no_telp', 'petugas resto')");        
                }
            } else {
                $data['pesan'] = 'Format Image invalid';
            }
        }
        else {
            $query = mysqli_query($conn, "INSERT INTO user VALUES('', '$nama', '$namagambar', '$username', '$password', '$level', '$no_telp', 'petugas resto')");
        }

        if($query){
            $data['hasil'] = true;
            $data['pesan'] = 'Data Added';
        } else {
            $data['pesan'] = mysqli_error($conn);
        }
    } else {
        $data['pesan'] = 'Username already registered!!!';
    }
}
if(isset($_GET['ubah'])){
    if($namagambar !== 'default.jpg'){
        if(move_uploaded_file($lokasi, '../assets/img/' . $namagambar)){
            if(file_exists('../assets/img/' . $gambarLama)){
                unlink('../assets/img/' . $gambarLama);
            }
        }
    }

    if($_FILES['image']['name'] == ''){
        $query = mysqli_query($conn, "UPDATE user SET nama_user='$nama', username='$username', password='$password', level='$level', no_telp='$no_telp' WHERE id_user='$id'");
    } else {
        $query = mysqli_query($conn, "UPDATE user SET nama_user='$nama', image='$namagambar', username='$username', password='$password', level='$level', no_telp='$no_telp' WHERE id_user='$id'");
    }

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = "Update Success";
    } else {
        $data['pesan'] = mysqli_error($conn);
    }
}

echo json_encode($data);