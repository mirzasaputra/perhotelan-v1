<?php
    $query = mysqli_query($conn, "SELECT transaksi_kamar.*, kamar.*, tipe_kamar.* FROM transaksi_kamar, kamar, tipe_kamar WHERE kamar.id_kamar=transaksi_kamar.id_kamar && kamar.status='terpakai' && tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3><i class="fas fa-bed pr-3 pl-2"></i> Room - <span class="small">Select Room Used</span></h3></div>
        <div class="card-body">
            <?php if(mysqli_num_rows($query) > 0){ ?>
            <div class="row">
                <?php foreach($query as $i) : ?>
                <div class="col-sm-3 mb-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="card-body-icon"><i class="fas fa-bed"></i></div>
                            <div class="mr-5">
                            <h3>No. <?=$i['no_kamar'];?></h3>
                            <span style="font-family: times;font-size: 20px"><?=$i['tipe_kamar'];?></span>
                            </div>
                        </div>
                        <a href="?module=chek_out_add&&id=<?=$i['id_transaksi_kamar'];?>" class="card-footer text-center text-white clearfix z-1 p-1">Select Room</a>
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