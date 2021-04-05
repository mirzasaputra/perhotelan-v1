<?php
$tersedia = mysqli_query($conn, "SELECT * FROM kamar WHERE status='tersedia'");
$terpakai = mysqli_query($conn, "SELECT * FROM kamar WHERE status='terpakai'");
$kotor = mysqli_query($conn, "SELECT * FROM kamar WHERE status='kotor'");
$booking = mysqli_query($conn, "SELECT * FROM booking WHERE status=1");

$tersedia = mysqli_num_rows($tersedia);
$terpakai = mysqli_num_rows($terpakai);
$kotor = mysqli_num_rows($kotor);
$booking = mysqli_num_rows($booking);

$user = $_SESSION["user"];
$pass = $_SESSION["pass"];
$data_user = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' && password ='$pass'");
$data_user = mysqli_fetch_array($data_user);
$data_perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan");
$data_perusahaan = mysqli_fetch_array($data_perusahaan);

//date
date_default_timezone_set("asia/jakarta");
$tgl = new DateTime("now");
$date = $tgl->format("D, d M Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>System Informasi Managemen Perhotelan</title>
        <?php include "template/header.php";?>

        <?php include "template/script.php";?>
    </head>
    <body style="background: #ece9e9;">
        <?php include "template/sidebar.php";?>

        <?php include "template/navbar.php";?>

        <?php
        if(!empty($_GET['module'])){
          include 'template/module/'.$_GET['module'].'.php';
        }
        else {
            if($data_user['level'] == 'Waiter' | $data_user['level'] == 'Kasir' | $data_user['level'] == 'Admin Resto' | $data_user['level'] == 'Owner'){
                include 'template/module/restaurant/home.php';
            } else {
                include 'template/module/dashboard.php';
            }
        }
        ?>

        <?php include "template/footer.php";?>
        
        <script>
    $(document).ready(function(){

        $("#logout").click(function(){
            swal({
                title: "Logout?",
                icon: "warning",
                text: "Are you sure want to logout?",
                buttons: true,
                dangerMode: true
            }).then(function(keluar){
                if(keluar){
                  window.location.assign("logout");
                }
            });
        });

    });
</script>
    </body>
</html>