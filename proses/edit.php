<?php
//load database
include "../config/database.php";

//menampilkan pesan error
$data['hasil'] = false;
$data['pesan'] = 'Terjadi Kesalahan';

if($_GET['modal'] == 'tipe_kamar'){
    //mengambil nilai variabel
    $id_tipe_kamar = $_POST['id'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga_per_mlm = $_POST['harga_per_mlm'];
    $harga_per_org = $_POST['harga_per_org'];

    //query ke database
    $query = mysqli_query($conn, "UPDATE tipe_kamar SET tipe_kamar='$tipe_kamar', harga_per_mlm='$harga_per_mlm', harga_per_org='$harga_per_org' WHERE id_tipe_kamar='$id_tipe_kamar'");
}
elseif($_GET['modal'] == 'kamar'){
    //mengambil nilai variabel
    $id_kamar = $_POST['id'];
    $no_kamar = $_POST['no_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $max_dewasa = $_POST['max_dewasa'];
    $max_anak = $_POST['max_anak'];
    $status = $_POST['status'];

    //query ke database
    $query = mysqli_query($conn, "UPDATE kamar SET no_kamar='$no_kamar', id_tipe_kamar='$tipe_kamar', max_dewasa='$max_dewasa', max_anak='$max_anak', status='$status' WHERE id_kamar='$id_kamar'");
}
elseif($_GET['modal'] == 'tamu'){
    $id_tamu = $_POST['id'];
    $prefix = $_POST['prefix'];
    $nama_depan = $_POST['nama_depan'];
    $nama_blkg = $_POST['nama_blkg'];
    $tipe_identitas = $_POST['tipe_identitas'];
    $no_identitas = $_POST['no_identitas'];
    $warga_negara = $_POST['warga_negara'];
    $jalan = $_POST['jalan'];
    $no_jalan = $_POST['no_jalan'];
    $kabupaten = $_POST['kabupaten'];
    $provinsi = $_POST['provinsi'];
    $no_telp = $_POST['no_telp'];

    $query = mysqli_query($conn, "UPDATE tamu SET prefix='$prefix', nama_depan='$nama_depan', nama_belakang='$nama_blkg', tipe_identitas='$tipe_identitas', no_identitas='$no_identitas', warga_negara='$warga_negara', jalan='$jalan', no_jalan='$no_jalan', kabupaten='$kabupaten', provinsi='$provinsi', no_telp='$no_telp' WHERE id_tamu='$id_tamu'");
}
elseif($_GET['modal'] == 'user'){
    //mengambil nilai variabel
    $id_user = $_POST['id_user'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['user'];
    if($_POST['passLama'] == $_POST['pass']){
        $password = $_POST['passLama'];
    } else {
        $password = md5($_POST['pass']);
    }
    $level = $_POST['level'];
    $no_telp = $_POST['no_telp'];

    //image
    if(empty($_FILES['image']['name'])){
        $namagambar = $_POST['valueImage'];
    } else {
        $gambarLama = $_POST['valueImage'];
        $gambar = $_FILES['image']['name'];
        $lokasi = $_FILES['image']['tmp_name'];
        $extensi = explode('.', $gambar);
        $extensi = strtolower(end($extensi));
        $extensiValid = ['jpeg', 'png', 'jpg'];
        $namagambar = 'User_';
        $namagambar .= rand(0, 999999);
        $namagambar .= '_'.rand(0, 999999);
        $namagambar .= '.'.$extensi;
        move_uploaded_file($lokasi, '../assets/img/'.$namagambar);
        if(file_exists('../assets/img/'.$gambarLama)){
            unlink('../assets/img/'.$gambarLama);
        }
    }

    $query = mysqli_query($conn, "UPDATE user SET nama_user='$nama_user', image='$namagambar', username='$username', password='$password', level='$level', no_telp='$no_telp' WHERE id_user='$id_user'");
}
elseif($_GET['modal'] == 'kamar_kotor'){
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = mysqli_query($conn, "UPDATE kamar SET status='$status' WHERE id_kamar='$id'");
}


//membuat kondisi jika berhasil maka menampilkan success
if(isset($query)){
    $data['hasil'] = true;
    $data['pesan'] = 'Data has been updated';
} else {
    $data['hasil'] = false;
    $data['pesan'] = 'An error occurred while updating';
}

if($_GET['modal'] == 'update_pesanan'){
    $id = $_GET['id'];
    $status = 'Menunggu diantar';
                                    
    $a = mysqli_query($conn, "SELECT SUM(total_harga) as total FROM pesanan_detail WHERE id_pesanan='$id'");
    $b = mysqli_fetch_array($a);
    $total = $b['total'];
                                    
    $query = mysqli_query($conn, "UPDATE pesanan SET total='$total', status='$status' WHERE id_pesanan='$id'");

    if($query){
        $data['hasil'] = true;
        $data['pesan'] = "Order is being processed, please wait";
    } else {
        $data['hasil'] = false;
        $data['pesan'] = mysqli_error($conn);
    }
}

echo json_encode($data);