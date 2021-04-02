<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tamu");
$tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id_tamu='$id'");
$tamu = mysqli_fetch_array($tamu);

if(isset($_GET['id_booking'])){
    $id_booking = $_GET['id_booking'];
    $booking = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking='$id_booking'");
    $b = mysqli_fetch_assoc($booking);
}
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?module=chek_in">Select Guest</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Chek In</h3></div>
        <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Add Room</button>
                            
                            <br><br><br>

                            <div id="viewDataRoom" data-id="<?=$id;?>"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-4">
                    <form action="proses/chek_in.php?check_in" method="post" id="formChekIn">
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>No. Invoice</label>
                                    <input type="hidden" name="id_transaksi" value="<?=$_GET['id_transaksi'];?>">
                                    <input type="text" class="form-control" name="no_invoice" value="<?='INV-' . rand(1, 99999999) . '-' . rand(1, 99);?>" readonly>
                                    <?php if(isset($_GET['id_booking'])) : ?>
                                        <input type="hidden" name="id_booking" value="<?=$_GET['id_booking'];?>">
                                    <?php endif;?>
                                </div>
                                <div class="col-sm-6">
                                    <label>Guest Name</label>
                                    <input type="hidden" name="tamu_id" value="<?=$id;?>">
                                    <input type="text" class="form-control" value="<?=$tamu['prefix'] .' '. $tamu['nama_depan'] .' '. $tamu['nama_belakang'];?>" readonly>
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
                                    <input type="date" class="form-control" name="tgl_chek_out" <?=(isset($_GET['id_booking']) ? 'value="'. $b['tgl_checkout'] .'"' : '');?> required>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <input type="text" class="form-control" name="waktu_chek_out" placeholder="Time Chek Out" <?=(isset($_GET['id_booking']) ? 'value="'. $b['waktu_checkout'] .'"' : 'value="12:00"');?> required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Down Payment</label>
                            <input type="text" class="form-control" name="deposit" placeholder="Jumlah Deposit" <?=(isset($_GET['id_booking']) ? 'value="'. $b['deposit'] .'"' : '');?> required>
                            <i class="ml-2 text-muted small">*Enter numbers without periods(.). Exp : 90000</i>
                        </div>
                        <div class="form-group">
                            <label>Payment Metode</label><br>
                            <input type="radio" class="ml-2" name="metode" <?=(isset($_GET['id_booking']) && $b['metode_pembayaran'] == 'cash') ? 'checked' : '';?> value="cash" id="cash"> <label for="cash">Cash</label>
                            <input type="radio" class="ml-4" name="metode" <?=(isset($_GET['id_booking']) && $b['metode_pembayaran'] == 'transfer') ? 'checked' : '';?> value="transfer" id="tf"> <label for="tf">Trasfer</label>
                            <input type="radio" class="ml-4" name="metode" <?=(isset($_GET['id_booking']) && $b['metode_pembayaran'] == 'EDC') ? 'checked' : '';?> value="EDC" id="edc"> <label for="edc">EDC</label>
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
        loadDataRoom();

        function loadDataRoom()
        {
            var id = $('#viewDataRoom').data('id');

            $.ajax({
                url: '<?=(isset($_GET['id_booking']) ? 'template/ajax/data_booking_room.php?id=' : 'template/ajax/data_room.php?id=');?>'+ id +'&&<?=(isset($_GET['id_booking']) ? 'id_booking='. $_GET['id_booking'] : 'id_transaksi='. $_GET['id_transaksi']);?>',
                dataType: 'html',
                success: function(data){
                    $('#viewDataRoom').html(data);

                    $('#formRoom').submit(function(e){
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
                                    $('#myModal').modal('hide');
                                    $('.modal-backdrop').remove();
                                    $('body').removeClass('modal-open');
                                    swal({
                                        title: 'Success',
                                        icon: 'success',
                                        text: data.pesan
                                    });
                                    loadDataRoom();
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

                    $('.action').click(function(){
                        var id = $(this).data('id');
                        var toggle = $(this).data('toggle');

                        if(toggle == 'delete'){
                            $.ajax({
                                url: 'proses/hapus.php?hapus=transaksi_kamar_detail&&id='+ id,
                                dataType: 'json',
                                success: function(data){
                                    if(data.hasil == true){
                                        loadDataRoom();
                                    } else {
                                        swal({
                                            title: 'Failed',
                                            icon: 'error',
                                            text: data.pesan
                                        });
                                    }
                                }
                            })
                        }
                    })
                }
            })
        }

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