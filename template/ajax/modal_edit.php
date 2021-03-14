<?php
include '../../config/database.php';
$id = $_GET['id'];

if($_GET['modal'] == 'tipe_kamar') :
$query = mysqli_query($conn, "SELECT * FROM tipe_kamar WHERE id_tipe_kamar='$id'");
$i = mysqli_fetch_array($query);
$per_mlm = $i['harga_per_mlm'];
$per_org = $i['harga_per_org'];
?>
    <input type="hidden" name="id" value="<?=$i['id_tipe_kamar'];?>">
    <div class="form-group">
        <label>Room Type</label>
        <input type="text" class="form-control" name="tipe_kamar" placeholder="Tipe Kamar" value="<?=$i['tipe_kamar'];?>" required>
    </div>
    <div class="form-group">
        <label>Price Per Night</label>
        <input type="number" class="form-control" name="harga_per_mlm" placeholder="Price Per Night" value="<?=$per_mlm;?>" required>
        <i class="small text-secondary ml-3">*Enter number without periods(.) exp : 100000</i>
    </div>
    <div class="form-group">
        <label>Price Per people</label>
        <input type="number" class="form-control" name="harga_per_org" placeholder="Price Per People" value="<?=$per_org;?>" required>
        <i class="small text-secondary ml-3">*Enter number without periods(.) exp : 100000</i>
    </div>
<?php endif;?>

<!--edit kamar-->
<?php if($_GET['modal'] == 'kamar') : 
$query = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar='$id'");
$i = mysqli_fetch_array($query);
$max_dewasa = $i['max_dewasa'];
$max_anak = $i['max_anak'];
$status = $i['status'];
?>
<input type="hidden" name='id' value="<?=$i['id_kamar'];?>">
<div class="form-group">
    <label>No. Room</label>
    <input type="text" class="form-control" name="no_kamar" placeholder="No. Kamar" value="<?=$i['no_kamar'];?>" required>
</div>
<div class="form-group">
    <label>Room Type</label>
    <select name="tipe_kamar" class="form-control">
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM tipe_kamar");
        while($i = mysqli_fetch_array($query)) :
        ?>
        <option value="<?=$i['id_tipe_kamar'];?>"><?=$i['tipe_kamar'];?></option>
        <?php endwhile;?>
    </select>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label>Max. Adult</label>
            <input type="number" class="form-control" name="max_dewasa" placeholder="Max. Adult" value="<?=$max_dewasa;?>" required>
        </div>
        <div class="col-sm-6">
            <label>Max. Children</label>
            <input type="number class="form-control" name="max_anak" placeholder="Max. Children" value="<?=$max_anak;?>" required>
        </div>
    </div>
</div>
<div class="form-group">
    <label>Statuse</label>
    <select name="status" class="form-control">
    <?php if($status == 'Tersedia'){ ?>
        <option value="Tersedia" selected>Available</option>
        <option value="Terpakai">Used</option>
        <option value="Kotor">Dirty</option>
    <?php } elseif($status == "Terpakai"){ ?>
        <option value="Tersedia">Available</option>
        <option value="Terpakai" selected>Used</option>
        <option value="Kotor">Dirty</option>
    <?php } else { ?>
        <option value="Tersedia">Available</option>
        <option value="Terpakai">Used</option>
        <option value="Kotor" selected>Dirty</option>
    <?php } ?>
</div>
<?php endif; ?>

<?php if($_GET['modal'] == "laundry") : ?>

    <input type="radio" name="tab" id="tab1" checked>
    <input type="radio" name="tab" id="tab2">
    <input type="radio" name="tab" id="tab3">
    <label for="tab1" class="btn-tab t-1">Gentlemen</label>
    <label for="tab2" class="btn-tab t-2">Ladies</label>
    <label for="tab3" class="btn-tab t-3">Children</label>

    <!--Tab 1-->
    <div class="tab1">
        <h3 class="text-center mb-4">Gentlemen</h3>
        <?php $men = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='gentlemen'");
        foreach($men as $men) : ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 text-md-right"><label><?=$men['nama'];?></label></div>
                <div class="col-sm-9"><input type="text" name="gentlemen_<?=$men['id_jenis_laundry'];?>" class="form-control" value="<?=$men['harga'];?>" placeholder="<?=$men['nama'];?>..."></div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

    <!--Tab 2-->
    <div class="tab2">
        <h3 class="text-center mb-4">Ladies</h3>
        <?php $ladies = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='ladies'");
        foreach($ladies as $p) : ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 text-md-right"><label><?=$p['nama'];?></label></div>
                <div class="col-sm-9"><input type="text" name="ladies_<?=$p['id_jenis_laundry'];?>" class="form-control" value="<?=$p['harga'];?>" placeholder="<?=$p['nama'];?>..."></div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

    <!--Tab 3-->
    <div class="tab3">
        <h3 class="text-center mb-4">Children</h3>
        <?php $child = mysqli_query($conn, "SELECT * FROM jenis_laundry WHERE type='children'");
        foreach($child as $child) : ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 text-md-right"><label><?=$child['nama'];?></label></div>
                <div class="col-sm-9"><input type="text" name="child_<?=$child['id_jenis_laundry'];?>" class="form-control" value="<?=$child['harga'];?>" placeholder="<?=$child['nama'];?>..."></div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

<?php endif;?>

<?php if($_GET['modal'] == 'pembayaran_laundry') : ?>
    <?php
    $query = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM kamar, laundry WHERE laundry.id_laundry='$id' && kamar.id_kamar=laundry.id_kamar");
    $data = mysqli_fetch_array($query);
    ?>
    <h5 class="text-center">Laundry Payment</h5>
    <hr>
    <div class="row" style="font-family: courier new;">
        <div class="col-sm-6 mb-3">
            <span><strong>Room. <?=$data['no_kamar'];?></strong></span><br>
            <span><strong>Date/time : <?=$data['waktu'] . ' / ' . $data['tanggal'];?></strong></span>
        </div>
        <div class="col-sm-6 mb-3">
            <span><strong>Statuse <span class="badge badge-warning"><?=$data['status'];?></span></strong></span>
        </div>
    </div>

    <h6 class="mx-3"><strong>Laundry Detail</strong></h6>
    <hr class="m-1 mb-3">
    <div class="table-responsive">
        <table class="table table-borderd">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Type Clothes</th>
                    <th>Article</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php $query = mysqli_query($conn, "SELECT laundry_detail.*, jenis_laundry.*, laundry.* FROM laundry_detail, jenis_laundry, laundry WHERE laundry.id_laundry='$id' && laundry_detail.id_laundry='$id' && jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry");foreach($query as $i) : ?>
                <tr>
                    <td style="text-transform: uppercase;"><?=$i['type'];?></td>
                    <td><?=$i['nama'];?></td>
                    <td><?=$i['article'];?></td>
                    <td>Rp. <?=number_format($i['harga'], 0, ',', '.');?>,-</td>
                    <td><?=$i['qty'];?></td>
                    <td>Rp. <?=number_format($i['harga'] * $i['qty'], 0, ',', '.');?>,-</td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfooter>
                <tr>
                    <th colspan="3" class="border-0"></th>
                    <th colspan="2" class="border  p-2">Sub Total</th>
                    <th class="border  p-2">Rp. <?=number_format($i['total'], 0, ',', '.');?>,-</th>
                </tr>
                <tr>
                    <th colspan="3" class="border-0"></th>
                    <th colspan="2" class="border  p-2">21% Tax + Service</th>
                    <th class="border  p-2">Rp. <?=number_format($i['total'] * 0.21, 0, ',', '.');?>,-</th>
                </tr>
                <tr>
                    <th colspan="3" class="border-0"></th>
                    <th colspan="2" class="border  p-2">Grand Total</th>
                    <th class="border  p-2">Rp. <?=number_format($i['total'] + ($i['total'] * 0.21), 0, ',', '.');?>,-</th>
                </tr>
            </tfooter>
        </table>
    </div>
    <div class="form-group mt-3">
        <label>Pay</label>
        <input type="hidden" name="id" value="<?=$id;?>">
        <input type="hidden" name="total" value="<?=$i['total'] + ($i['total'] * 0.21);?>">
        <input type="text" name="bayar" class="form-control" placeholder="Pay..." required>
    </div>
<?php endif;?>

<?php if($_GET['modal'] == 'fasilitas') : ?>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id='$id'");
    $i = mysqli_fetch_array($query);
    ?>
    <input type="hidden" name="id" value="<?=$i['id'];?>">
    <div class="form-group">
        <label>Fasilitas Name</label>
        <input type="text" class="form-control" name="fasilitas" placeholder="Fasilitas Name" value="<?=$i['fasilitas_name'];?>" required autocomplete="off">
    </div>
<?php endif;?>