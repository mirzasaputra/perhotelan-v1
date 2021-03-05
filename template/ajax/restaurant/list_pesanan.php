<?php
session_start();
$id_pesanan = $_SESSION['id_pesanan'];
include "../../../config/database.php";
$query = mysqli_query($conn, " SELECT pesanan_detail.*, menu.* FROM pesanan_detail, menu WHERE pesanan_detail.id_pesanan='$id_pesanan' && menu.id_menu=pesanan_detail.id_menu");
?>
<div class="card bg-light" style="font-family: courier new">
    <div class="card-header"><h4><i class="fas fa-list"></i> Orders</h4></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hovered">
                <tr align="center">
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th colspan="2">Total</th>
                </tr>
                <?php foreach($query as $i) : ?>
                <tr style="font-size: 12px;">
                    <td width="25%"><?=$i['nama_menu'];?></td>
                    <td>Rp. <?=number_format($i['harga_menu'], 0, ',', '.');?></td>
                    <td width="10%"><?=$i['qty'];?></td>
                    <td>Rp. <?=number_format($i['harga_menu'] * $i['qty'], 0, ',', '.');?></td>
                    <td width="3%" style="font-weight: bold;padding: 0;padding-top: 11px"><button class="hapus" value="<?=$i['id_pesanan_detail'];?>" style="padding: 0;width: 15px;background: rgb(180, 30, 30);color: white;border: none;">&times;</button></td>
                </tr>
                <?php endforeach;?>
                <?php $query = mysqli_query($conn, "SELECT SUM(total_harga) as total FROM pesanan_detail WHERE id_pesanan='$id_pesanan'");$i=mysqli_fetch_array($query);?>
                <tr>
                    <td></td>
                    <td class="border" colspan="2">Total</td>
                    <td class="border text-danger" colspan="2">Rp. <?=number_format($i['total'], 0, ',', '.');?></td>
                </tr>
            </table>
        </div>
        <br>
        <button class="btn btn-info mb-2 float-right konfirm" value="<?=$id_pesanan;?>"><i class="fas fa-paper-plane"></i> Confirm</button>
        <br>
    </div>
    <div class="card-footer small text-center text-muted">Copyright&copy 2019 | System Managemen Perhotelan</div>
</div>

<!--Modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="formPesan">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-utensils"></i> Order Service</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>No. ID Orders</label>
                        <input type="text" class="form-control" name="id_pesanan" value="<?=$_SESSION['id_pesanan'];?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Name Menu</label>
                        <input type="text" class="form-control" id="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="harga" id="harga" readonly>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="qty" value="1" placeholder="Quantity" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Order</button>
                </div>
            </form>
        </div>
    </div>
</div>