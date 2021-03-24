<?php
include "../../config/database.php";
$query = mysqli_query($conn, "SELECT kamar.*, tipe_kamar.* FROM kamar, tipe_kamar WHERE kamar.status='kotor' && tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Room - <span class="small">Dirty Room</span></h3></div>
        <div class="card-body">
            <div class="row">
                <?php if(mysqli_num_rows($query) > 0) : foreach($query as $i) : ?>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <div class="card-body-icon"><i class="fas fa-bed"></i></div>
                                <div class="mr-5">
                                    <h3>No. <?=$i['no_kamar'];?></h3>
                                    <span style="font-family: times;font-size: 20px"><?=$i['tipe_kamar'];?></span>
                                </div>
                            </div>
                            <a class="card-footer clearfix z-1 p-1 text-center text-white update" id="update" value="<?=$i['id_kamar'];?>" href="#myModal" data-toggle="modal">Update</a>
                        </div>
                    </div>
                <?php endforeach;endif;if(mysqli_num_rows($query) <= 0) : ?>
            </div>
                <div class="col-sm-4 mx-auto mt-3 mb-3 text-center" style="overflow: hidden">
                    <img src="assets/img/empty_cart.jpg" width="250" alt="">
                </div>
            <?php endif;?>
        </div>
    </div>

</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="proses/edit.php?modal=kamar_kotor" method="post" id="formModal">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-bed"></i> Update Kamar</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="from-group">
                        <label>ID Kamar</label>
                        <input type="text" id="id" class="form-control" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status Kamar</label>
                        <select name="status" id="" class="form-control">
                            <option value="Tersedia">Available</option>
                            <option value="Terpakai">Used</option>
                            <option value="Kotor">Dirty</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>