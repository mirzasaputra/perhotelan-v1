<?php
include "../../../config/database.php";
date_default_timezone_set('asia/jakarta');
$date = new dateTime('now');
$date = $date->format('Y-m-d');
$query = mysqli_query($conn, "SELECT * FROM pesanan WHERE tanggal='$date' ORDER BY waktu DESC");
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12 mb-3">
            <div class="card bg-light border-top-2-warning rounded-lg">
                <div class="card-body" style="min-height: 200px">
                    <h5 class="text-muted">Order Report</h5>
                    <p class="text-muted m-0">Number Of Orders : <b><?=mysqli_num_rows($query);?></b> Order</p>
                    <hr class="mt-3 mb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered text-secondary" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="10%">ID Pesanan</th>
                                    <th>Date / Time</th>
                                    <th>Total</th>
                                    <th width="10%">Statuse</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query as $i) : ?>
                                <tr>
                                    <td><?=$i['id_pesanan'];?></td>
                                    <td><?=$i['waktu'] . " / " . $i['tanggal'];?></td>
                                    <td>Rp. <?=number_format($i['total'], 0, ',', '.');?></td>
                                    <td><div class="badge badge-warning pt-2 pb-2 text-white"><?=$i['status'];?></div></td>
                                    <td><button class="btn btn-info lihat" value="<?=$i['id_pesanan'];?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i> View</button></td>
                                </tr>
                                <?php endforeach;?>
                                <?php $query = mysqli_query($conn, "SELECT SUM(total) as total FROM pesanan WHERE tanggal='$date'");$i=mysqli_fetch_array($query);?>
                                <tr>
                                    <th colspan="2">Total Income</th>
                                    <th colspan="2">Rp. <?=number_format($i['total'], 0, ',', '.');?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php $pesanan_masuk = mysqli_query($conn, "SELECT * FROM pesanan WHERE status='menunggu diantar'");?>
        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
            <div class="card bg-light border-top-2-warning">
                <div class="card-body">
                    <h5 class="text-muted">Order In <span class="small"><span class="badge badge-danger"><?=mysqli_num_rows($pesanan_masuk);?></span></span></h5>
                    <p class="text-muted m-0">Statuse <span class="badge badge-warning text-white">Waiting for delivery</span></p>
                    <hr>
                    <div class="box text-muted">
                        <?php
                        if(mysqli_num_rows($pesanan_masuk)){
                            $pesanan = mysqli_query($conn, "SELECT transaksi_kamar.*, pesanan.*, kamar.* FROM pesanan, transaksi_kamar, kamar WHERE pesanan.status='Menunggu Diantar' && pesanan.lokasi_pemesanan='dari kamar' && transaksi_kamar.id_transaksi_kamar=pesanan.id_transaksi_kamar && kamar.id_kamar=transaksi_kamar.id_kamar");
                            foreach($pesanan as $a) : ?>
                                <div class="info-box mb-3">
                                    <center class="mb-2">
                                        <strong>Room : <?=$a['no_kamar'];?></strong>
                                    </center>
                                    ID Orders : <?=$a['id_pesanan'];?>
                                    <br>
                                    Time Order : <?=$a['waktu'];?> | <?=$a['tanggal'];?>
                                    <br>
                                    <div class="text-right"><button class="btn btn-info mt-2 mb-3 lihat" value="<?=$a['id_pesanan'];?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i> View Orders</button></div>
                                </div>
                            <?php endforeach;?>

                            <?php
                            $pesanan = mysqli_query($conn, "SELECT pesanan.*, meja.* FROM pesanan, meja WHERE pesanan.status='Menunggu Diantar' && pesanan.lokasi_pemesanan='dari resto' && meja.id_meja=pesanan.id_meja");
                            foreach($pesanan as $b) : ?>
                                <div class="info-box">
                                    <center class="mb-2">
                                        <strong>Table : <?=$b['kd_meja'];?></strong>
                                    </center>
                                    ID Orders : <?=$b['id_pesanan'];?>
                                    <br>
                                    Waktu Order : <?=$b['waktu'];?> | <?=$b['tanggal'];?>
                                    <br>
                                    <div class="text-right"><button class="btn btn-info mt-2 mb-3 lihat" value="<?=$b['id_pesanan'];?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i> View Order</button></div>
                                </div>
                            <?php 
                            endforeach;
                        } else {
                        ?>
                            <center><img src="assets/img/empty_cart.jpg" alt=""></center>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/konfirmasi_pesanan.php" method="post" id="formModal">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> Orders</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="viewDataModal"></div>
            </form>
        </div>
    </div>
</div>