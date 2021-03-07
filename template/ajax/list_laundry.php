<?php
session_start();
include "../../config/database.php";
$query = mysqli_query($conn, "SELECT * FROM laundry_detail WHERE id_laundry='" . $_SESSION['id_laundry'] . "'");
?>
<div class="row">
    <div class="col-sm-6 mb-3">
        <div class="card bg-light">
            <form action="proses/laundry.php?act=input" method="post" id="form">
                <div class="modal-header">
                    <h5 class="modal-title">Form Laundry</h5>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" style="text-transform: uppercase;"><?=$_SESSION['type'];?></h5>
                    <div class="form-group">
                        <label>Type Clothes</label>
                        <input type="hidden" name="id_laundry" value="<?=$_SESSION['id_laundry'];?>">
                        <select name="id_jenis_laundry" class="form-control">
                            <option value="">Select type</option>
                            <?php $query = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='" . $_SESSION['type'] . "'");foreach($query as $i) : ?>
                                <option value="<?=$i['id_jenis_laundry'];?>"><?=$i['nama'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Article</label>
                        <input type="text" name="nama" class="form-control" placeholder="Article..." required>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="qty" value="1" minValue="1" class="form-control" placeholder="Quantity...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6 mb-3">
        <div class="card bg-light" style="max-height: 460px">

            <div class="card-header"><h5><i class="fas fa-list"></i> List Laundry</h5></div>
            <div class="card-body">
                <?php if(mysqli_num_rows($query) <=0){ ?>
                    <center class="mt-4  mb-5"><img src="assets/img/empty_cart.jpg" alt=""></center>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-hovered text-center">
                            <thead>
                                <tr>
                                    <th width='1%'>No.</th>
                                    <th>Type</th>
                                    <th width='25%'>Article</th>
                                    <th>Qty</th>
                                    <th colspan='2'>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1; $query = mysqli_query($conn, "SELECT laundry_detail.*, jenis_laundry.* FROM laundry_detail, jenis_laundry WHERE jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry && laundry_detail.id_laundry='" . $_SESSION['id_laundry'] . "'");foreach($query as $i) : ?>
                                    <tr>
                                        <td><?=$no++;?>.</td>
                                        <td><?=$i['nama'];?></td>
                                        <td><?=$i['article'];?></td>
                                        <td><?=$i['qty'];?></td>
                                        <td>Rp. <?=number_format($i['total'], 0, ',', '.');?></td>
                                        <td width="2%" style="font-weight: bold;padding: 0;padding-top: 11px"><button class="hapus" value="<?=$i['id_laundry_detail'];?>" style="padding: 0;width: 15px;background: rgb(180, 30, 30);color: white;border: none;">&times;</button></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>

                            <tfooter>
                                <?php $query = mysqli_query($conn, "SELECT SUM(total) as total FROM laundry_detail WHERE id_laundry='" . $_SESSION['id_laundry'] . "'");$total = mysqli_fetch_array($query);?>
                                <tr>
                                    <td colspan="2"></td>
                                    <th colspan="2" class="border">Total</th>
                                    <th colspan="2" class="border">Rp. <?=number_format($total['total'], 0, ',', '.');?></th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
                    <div class="form-group mt-3 pr-3 text-right">
                        <form action="proses/laundry.php?act=confirm" method="post" id="formKonfirmasi">
                            <input type="hidden" name="total" value="<?=$total['total'];?>">
                            <input type="hidden" name="id_laundry" value="<?=$_SESSION['id_laundry'];?>">
                            <button class="btn btn-info" type="submit"><i class="fas fa-paper-plane"></i> Confirm</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <div class="card-footer text-center text-muted small">Copyright&copy 2019 | System Manajemen Perhotelan</div>

        </div>
    </div>
</div>