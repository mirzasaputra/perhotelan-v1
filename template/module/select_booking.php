<?php
    $query = mysqli_query($conn, "SELECT booking.*, tamu.* FROM booking, tamu WHERE tamu.id_tamu=booking.id_tamu && status=1");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header">
            <a href="?module=chek_in" class="btn btn-primary float-right"><i class="fas fa-list"></i> Select Guest</a>
            <h3><i class="fas fa-bed pr-3 pl-2"></i> Guest - <span class="small">Select guest</span></h3>
        </div>
        <div class="card-body">
            <?php if(mysqli_num_rows($query) > 0){ ?>
            <div class="row">
                <?php foreach($query as $i) : ?>
                <div class="col-sm-3 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="card-body-icon"><i class="fas fa-user"></i></div>
                            <div class="mr-5">
                            <h3><?=$i['prefix'] .'. '. $i['nama_depan'] .' '. $i['nama_belakang'];?></h3>
                            <?php $date = date_create($i['tgl_booking']);?>
                            <p class="m-0 p-0" style="font-family: times;font-size: 16px">Tgl Booking : <?=date_format($date, 'D, d M Y');?></p>
                            <?php $date = date_create($i['tgl_check_in']);?>
                            <p class="m-0 p-0" style="font-family: times;font-size: 16px">Tgl Check In : <?=date_format($date, 'D, d M Y');?></p>
                            </div>
                        </div>
                        <a href="?module=chek_in_add&&id=<?=$i['id_tamu'];?>&&id_transaksi=ID<?=rand(0, 9999999);?>&&id_booking=<?=$i['id_booking'];?>" class="card-footer text-center text-white clearfix z-1 p-1">Select Guest</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php } else { ?>
                <center><img src="assets/img/empty_cart.jpg" alt=""></center>
            <?php } ?>
        </div>
    </div>

</div>