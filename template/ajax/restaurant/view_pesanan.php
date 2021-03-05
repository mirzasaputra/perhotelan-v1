<?php
session_start();
include "../../../config/database.php";
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT pesanan_detail.*, transaksi_kamar.*, pesanan.*, tamu.*, menu.* FROM pesanan_detail, transaksi_kamar, pesanan, tamu, menu WHERE pesanan.id_pesanan='$id' && pesanan_detail.id_pesanan=pesanan.id_pesanan && transaksi_kamar.id_transaksi_kamar=pesanan.id_transaksi_kamar && tamu.id_tamu=transaksi_kamar.id_tamu && menu.id_menu=pesanan_detail.id_menu");
$i = mysqli_fetch_array($query);
?>
<div class="modal-body"  style="font-family: courier new; font-size: 15px;">
    <h6 class="text-center"><b>ID Pesanan : <?=$id;?></b></h6>
    <div class="row mt-4 mb-4">
        <div class="sm-6">
        <div class="pl-2">
            Name : <?=$i['prefix'] . " " . $i['nama_depan'] . " " . $i['nama_belakang'];?>
            <br>
            Time : <?=$i['waktu'];?> / <?=$i['tanggal'];?>
            </div>
        </div>
        <div class="col-sm-6 pl-5">
            Statuse <span class="badge badge-info pt-1 pb-1"><?=$i['status'];?></span>
        </div>
    </div>
    <h6><b>Rincian Pesanan : </b></h6>
    <table class="table">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($query as $a) : ?>
            <tr>
                <td><?=$a['nama_menu'];?></td>
                <td>Rp. <?=number_format($a['harga_menu'], 0, ',', '.');?></td>
                <td><?=$a['qty'];?></td>
                <td>Rp. <?=number_format($a['total_harga'], 0, ',', '.');?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <th colspan="3">Total</th>
                <th>Rp. <?=number_format($a['total'], 0, ',', '.');?></th>
            </tr>
            <?php
            if($_SESSION['get'] == 'Kasir' && $i['status'] == 'selesai') : 
            $query = mysqli_query($conn, "SELECT * FROM transaksi_resto WHERE id_pesanan='$id'");
            foreach($query as $b) :
            ?>
            <tr>
                <th colspan="3">Pay</th>
                <th>Rp. <?=number_format($b['bayar'], 0, ',', '.');?></th>
            </tr>
            <tr>
                <th colspan="3">Refund</th>
                <th>Rp. <?=number_format($b['bayar'] - $b['total'], 0, ',', '.');?></th>
            </tr>
            <?php endforeach;endif;?>
        </tbody>
    </table>
</div>
<div class="modal-footer" style="position: none!important;display: block!important;text-align: right;">
    <?php if($i['status'] == "Menunggu diantar") : ?>
        <input type="hidden" name="id" value="<?=$id;?>">
        <button class="btn btn-info" type="submit"><i class="fas fa-paper-plane"></i> Confirm</button><br>
        <i class="text-muted small">*Klik the button if the order has been confirmed by waiter</i>
    <?php endif;?>
    <?php if($_SESSION['get'] == 'Kasir' && $i['status'] == 'Menunggu pembayaran') : ?>
        <div class="form-group text-left">
            <label>Pay</label>
            <input type="hidden" name="total" value="<?=$a['total'];?>">
            <input type="hidden" name="id" value="<?=$id;?>">
            <input type="text" class="form-control" name="bayar" placeholder="Pay..." required>
        </div>
        <button class="btn btn-info mr-3 mb-4"><i class="fas fa-paper-plane"></i> Pay</button>
    <?php endif;?>
    <?php if($_SESSION['get'] == 'Kasir' && $i['status'] == 'selesai') : ?>
        <a href="template/cetak.php?id_pesanan=<?=$id;?>&&cetak=bukti_pembayaran" target="_blank" class="btn btn-warning text-white mr-4 mb-4"><i class="fas fa-print"></i> Print prof</a>
    <?php endif;?>
</div>