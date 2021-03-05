<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM kamar, laundry WHERE laundry.id_laundry='$id' && kamar.id_kamar=laundry.id_kamar");
$data = mysqli_fetch_array($query);
?>
<div class="container">

    <h3>Laundry Detail</h3>
    <hr>
    
    <div class="row mt-4" style="font-family: courier new">
        <div class="col-sm-6 mb-3">
            <span><strong>Room. <?=$data['no_kamar'];?></strong></span><br>
            <span><strong>Date/Time : <?=$data['waktu'] . ' / ' . $data['tanggal'];?></strong></span>
        </div>
        <div class="col-sm-6 mb-3">
            <span><strong>Status <span class="badge badge-warning"><?=$data['status'];?><?php if($data['status'] == 'Processing'){echo "...";}?></span></strong></span>
        </div>
    </div>

    <div class="table-responsive px-md-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width='1%'>No.</th>
                    <th>Type</th>
                    <th>Type Clothes</th>
                    <th>Article</th>
                    <th>Price</th>
                    <th width='6%'>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;$query = mysqli_query($conn, "SELECT laundry_detail.*, jenis_laundry.*, laundry.* FROM laundry_detail, jenis_laundry, laundry WHERE laundry.id_laundry='$id' && laundry_detail.id_laundry='$id' && jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry");foreach($query as $i) : ?>
                <tr>
                    <td><?=$no++;?>.</td>
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
                    <th colspan="4" class="border-0"></th>
                    <th colspan="2">Sub Total</th>
                    <th>Rp. <?=number_format($i['total'], 0, ',', '.');?>,-</th>
                </tr>
                <tr>
                    <th colspan="4" class="border-0"></th>
                    <th colspan="2">21% Tax + Service</th>
                    <th>Rp. <?=number_format($i['total'] * 0.21, 0, ',', '.');?>,-</th>
                </tr>
                <tr>
                    <th colspan="4" class="border-0"></th>
                    <th colspan="2">Grand Total</th>
                    <th>Rp. <?=number_format($i['total'] + ($i['total'] * 0.21), 0, ',', '.');?>,-</th>
                </tr>

                <?php if($i['status'] == 'selesai') : ?>
                    <?php $query = mysqli_query($conn, "SELECT * FROM transaksi_laundry WHERE id_laundry='$id'");$a = mysqli_fetch_array($query);?>
                    <tr>
                        <th colspan="4" class="border-0"></th>
                        <th colspan="2">Pay</th>
                        <th>Rp. <?=number_format($a['bayar'], 0, ',', '.');?>,-</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="border-0"></th>
                        <th colspan="2">Refund</th>
                        <th>Rp. <?=number_format($a['bayar'] - $i['total'], 0, ',', '.');?>,-</th>
                    </tr>
                <?php endif;?>
            </tfooter>
        </table>
    </div>
    <br class="d-none d-md-block">
    <div class="px-2 px-md-5">
        <?php if($i['status'] == 'selesai'){ ?>
            <a href="?module=laundry" class="btn btn-danger mb-2">Cancel</a>
            <a href="template/cetak.php?cetak=bukti_laundry&id=<?=$id;?>" target="_blank" class="btn btn-warning mb-2"><i class="fas fa-print"> Bukti Pembayaran</i></a>
            <a href="?module=laundry" class="btn btn-success mb-2"><i class="fas fa-check"></i> Selesai</a>
        <?php } else { ?>
            <a href="?module=laundry" class="btn btn-danger mb-2">Cancel</a>
            <?php if($i['status'] == 'Menunggu pembayaran') : ?><a href="template/cetak.php?cetak=bill_laundry&id=<?=$id;?>" target="_blank" class="btn btn-warning mb-2"><i class="fas fa-print"></i> Print Bill</a><?php endif;?>
            <a href="<?php if($i['status'] == 'Menunggu pembayaran'){echo '#modal-bayar';}?>" <?php if($i['status'] == 'Menunggu pembayaran'){?> data-toggle="modal" <?php } ?> <?php if($i['status'] == 'Processing'){echo 'id="confirm"';}?> value="<?=$id;?>" class="btn btn-primary mb-2"><i class="fas fa-paper-plane"></i><?php if($i['status'] == 'Processing'){echo ' Confirm';} else {echo ' Pay';}?></a>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="modal-bayar" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-control">
            <form action="proses/laundry.php?act=pembayaran" method="post" id="bayar">
                <div class="modal-header">
                    <h5 class="modal-title">Payment</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="viewLaundry"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Pay</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $.get('template/ajax/modal_edit.php?modal=pembayaran_laundry&id=<?=$id;?>', function(data){
            $('#viewLaundry').html(data);
        });

        $('#bayar').submit(function(e){
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
                            window.location.assign('?module=viewLaundry&id=<?=$id;?>');
                        });
                        setInterval(function(){window.location.assign('?module=viewLaundry&id=<?=$id;?>');}, 3000);
                    } else {
                        swal({
                            title: 'Failed',
                            icon: 'error',
                            text: data.pesan
                        });
                    }
                }
            });
        });

        $('#confirm').click(function(e){
            let id = $(this).attr('value');
            e.preventDefault();
            $.ajax({
                url: 'proses/laundry.php?act=confirm_laundry&id='+id,
                dataType: 'json',
                success: function(data){
                    if(data.hasil == true){
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: data.pesan
                        }).then(function(){
                            window.location.assign('?module=viewLaundry&id=<?=$id;?>');
                        });
                        setInterval(function(){window.location.assign('?module=viewLaundry&id=<?=$id;?>');}, 3000);
                    } else {
                        swal({
                            title: 'Failed',
                            icon: 'error',
                            text: data.pesan
                        });
                    }
                }
            })
        })

    })
</script>