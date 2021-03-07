<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tamu");
$max_tamu = mysqli_query($conn, "SELECT kamar.*, tipe_kamar.* FROM kamar, tipe_kamar WHERE kamar.id_kamar='$id'");
$tamu = mysqli_fetch_array($max_tamu);
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?module=chek_in">Select Room</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Chek In</h3></div>
        <div class="card-body">
            <form action="proses/chek_in.php" method="post" id="formChekIn">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-7">
                                    <label>No. Invoice</label>
                                    <input type="hidden" name="harga_per_mlm" value="<?=$tamu['harga_per_mlm'];?>">
                                    <input type="text" class="form-control" name="no_invoice" value="<?='INV-' . rand(1, 99999999) . '-' . rand(1, 99);?>" readonly>
                                </div>
                                <div class="col-sm-5">
                                    <label>Guest Name</label>
                                    <input type="hidden" name="id_kamar" value="<?=$id;?>">
                                    <select class="form-control" name="id_tamu">
                                        <option>--Select--</option>
                                        <?php foreach($query as $i) : ?>
                                            <option value="<?=$i['id_tamu'];?>"><?=$i['prefix'];?>. <?=$i['nama_depan'];?> <?=$i['nama_belakang'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="alert bg-info text-white">
                                        <h3><?=$tamu['tipe_kamar'];?></h3>
                                        <p class="mt-2 m-0">Price / Night : Rp. <?=number_format($tamu['harga_per_mlm'], 0, ',', '.');?></p>
                                        <p class="m-0">Maximal Adult : <?=$tamu['max_dewasa'];?></p>
                                        <p class="m-0">Maximal Children : <?=$tamu['max_anak'];?></p>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="alert border text-dark">
                                        <a href="?module=tambah_tamu" class="text-info"><b>Click here</b></a>
                                        If the name question is not found to be added to the guest book.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>The number of guest</label>
                                    <select name="jumlah_dewasa" class="form-control">
                                        <option value=0>--Adult--</option>
                                        <?php for($i=1;$i<($tamu['max_dewasa'] + 1);$i++) : ?>
                                            <option value="<?=$i;?>"><?=$i;?> People</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <select name="jumlah_anak" class="form-control">
                                        <option value=0>--Children--</option>
                                        <?php for($i=1;$i<($tamu['max_anak'] + 1);$i++) : ?>
                                            <option value="<?=$i;?>"><?=$i;?> People</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date / Time Check In</label>
                                    <input type="text" class="form-control" name="tgl_chek_in" value="<?=$tgl->format('Y-m-d');?>" readonly>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <input type="text" class="form-control" name="waktu_chek_in" value="<?=$tgl->format('H:i');?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date / Time Check Out</label>
                                    <input type="date" class="form-control" name="tgl_chek_out" required>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <input type="text" class="form-control" name="waktu_chek_out" value="12:00" placeholder="Time Chek Out" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Down Payment</label>
                            <input type="text" class="form-control" name="deposit" placeholder="Jumlah Deposit" required>
                            <i class="ml-2 text-muted small">*Enter numbers without periods(.). Exp : 90000</i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <a href="?module=chek_in" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-key pr-1"></i> Chek In</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){

        $('#formChekIn').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.hasil == true){
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: data.pesan
                        }).then(function(){
                            window.location.assign('?module=dashboard');
                        });
                    }
                    else {
                        swal({
                            title: 'Failed',
                            icon: 'error',
                            text: data.pesan
                        });
                    }
                }
            });
        });

    });
</script>