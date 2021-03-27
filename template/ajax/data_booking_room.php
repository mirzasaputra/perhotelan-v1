<?php
include "../../config/database.php";
$id = $_GET['id_booking'];
$result = mysqli_query($conn, "SELECT booking_detail.*, kamar.*, tipe_kamar.* FROM booking_detail, kamar, tipe_kamar WHERE kamar.id_kamar=booking_detail.id_kamar && tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar && booking_detail.id_booking='$id'");
$room = mysqli_query($conn, "SELECT kamar.*, tipe_kamar.* FROM kamar, tipe_kamar WHERE tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar && kamar.status='tersedia'");
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width="1%">No.</th>
            <th>Room</th>
            <th>Adult</th>
            <th>Children</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(mysqli_num_rows($result) > 0) { ?>
            <?php $no = 1;foreach($result as $i) : ?>
            <tr>
                <td><?=$no++;?>.</td>
                <td>
                    Room No. <?=$i['no_kamar'];?><br>
                    Type : <?=$i['tipe_kamar'];?><br>
                    Price : Rp. <?=number_format($i['harga_per_mlm'], 0, ',','.');?>
                </td>
                <td width="15%"><?=$i['jumlah_dewasa'];?></td>
                <td width="15%"><?=$i['jumlah_anak'];?></td>
                <td width="1%" class="text-center"><button class="btn btn-danger action" data-toggle="delete" data-id="<?=$i['id_booking_detail'];?>"><i class="fas fa-times"></i></button></td>
            </tr>
            <?php endforeach;?>
        <?php } else { ?>
            <tr>
                <td colspan="5" class="text-center small text-muted"> No Room Selected </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/tambah.php?booking&&id=<?=$_GET['id_booking'];?>" method="post" id="formRoom">
                <div class="modal-header">
                    <h5>Add Room</h5>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Room</label>
                        <select name="room_id" class="form-control">
                            <option value="" selected disabled>Select Room</option>
                            <?php foreach($room as $r) : ?>
                                <option value="<?=$r['id_kamar'];?>"><?=$r['tipe_kamar'];?> | No. <?=$r['no_kamar'];?> | Rp. <?=number_format($r['harga_per_mlm'], 0, ',', '.');?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Dewasa</label>
                        <input type="number" name="dewasa" class="form-control" placeholder="Jumalah Dewasa">
                    </div>
                    <div class="form-group">
                        <label for="">Jumalah Anak</label>
                        <input type="number" name="anak" class="form-control" placeholder="Jumlah Anak">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>