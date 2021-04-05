<?php
    $query = mysqli_query($conn, "SELECT booking.*, tamu.* FROM booking, tamu WHERE tamu.id_tamu=booking.id_tamu && booking.status=1");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header">
            <h3><i class="fas fa-bed pr-3 pl-2"></i> Booking - <span class="small">View booking</span></h3>
        </div>
        <div class="card-body">
            <?php if(mysqli_num_rows($query) > 0){ ?>
            <div class="row">
                <?php foreach($query as $i) : ?>
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card bg-light shadow-sm">
                        <div class="card-body">
                            <div class="card-body-icon"><i class="fas fa-user"></i></div>
                            <div class="mr-5">
                            <h3><?=$i['prefix'] .'. '. $i['nama_depan'] .' '. $i['nama_belakang'];?></h3>
                            <?php $date = date_create($i['tgl_booking']);?>
                            <p class="m-0 text-muted"  style="font-family: times;font-size: 15px">Tgl Booking : <?=date_format($date, 'D, d M Y');?></p>
                            <?php $date = date_create($i['tgl_check_in']);?>
                            <p class="m-0 text-muted" style="font-family: times;font-size: 15px">Tgl checkin : <?=date_format($date, 'D, d M Y');?></p>
                            <p class="m-0 text-muted" style="font-family: times;font-size: 15px">Jumlah DP : Rp. <?=number_format(($i['deposit'] > 0) ? $i['deposit'] : 0, 0, ',', '.');?></p>
                            </div>
                        </div>
                        <div class="card-footer m-0 p-0">
                            <div class="btn-group w-100" role="group" aria-label="Basic example">
                                <a href="?module=booking_add&id=<?=$i['id_tamu'];?>&id_booking=<?=$i['id_booking'];?>&edit" type="button" class="btn border w-100"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a href="proses/booking.php?id=<?=$i['id_booking'];?>&delete" class="btn border w-100 hapus"><i class="fas fa-trash-alt"></i> Hapus</a>
                                <a href="?module=chek_in_add&&id=<?=$i['id_tamu'];?>&&id_transaksi=ID<?=rand(0, 9999999);?>&&id_booking=<?=$i['id_booking'];?>" type="button" class="btn border w-100"><i class="fas fa-key"></i> Checkin</a>
                            </div>
                        </div>
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

<script>
    $('.hapus').click(function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        swal({
            title: 'Delete?',
            icon: 'warning',
            text: 'Are you sure to delete item?',
            dangerMode: true,
            buttons: true
        }).then(function(result){
            if(result){
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(data){
                        if(data.hasil == true){
                            swal({
                                title: 'Success',
                                icon: 'success',
                                text: data.pesan
                            });
                            window.location.reload();
                        } else {
                            swal({
                                title: 'Failed',
                                icon: 'error',
                                text: data.pesan
                            })
                        }
                    }
                })
            }
        })
    })
</script>