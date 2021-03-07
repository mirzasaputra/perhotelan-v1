<?php
date_default_timezone_set('asia/jakarta');
$date = new DateTime;
$time = $date->format('H:i');
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header">
            <h3><i class="fas fa-check"></i> Select Type - <span class="small">Type laundry</span></h3>
        </div>
        <div class="card-body" style="font-family: courier new">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="card border-top-2-primary" style="background: rgb(240, 240, 240)">
                        <div class="card-body-icon" style="font-size: 80px; margin-top: 5px;margin-right: 5px">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <div class="card-body">
                            <h3>Gentlemen</h3>
                        </div>
                        <a href="#myModal" data-toggle="modal" value="gentlemen" class="tambah card-footer small clearfix z-index p-1 text-center text-dark">Select</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="card border-top-2-primary" style="background: rgb(240, 240, 240)">
                        <div class="card-body-icon" style="font-size: 80px; margin-top: 5px;margin-right: 5px">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <div class="card-body">
                            <h3>Ladies</h3>
                        </div>
                        <a href="#myModal" data-toggle="modal" value="ladies" class="tambah card-footer small clearfix z-index p-1 text-center text-dark">Select</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="card border-top-2-primary" style="background: rgb(240, 240, 240)">
                        <div class="card-body-icon" style="font-size: 80px; margin-top: 5px;margin-right: 5px">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <div class="card-body">
                            <h3>Children</h3>
                        </div>
                        <a href="#myModal" data-toggle="modal" value="children" class="tambah card-footer small clearfix z-index p-1 text-center text-dark">Select</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--myModal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/laundry.php?act=add" method="post" id="form">
                <div class="modal-header">
                    <h5 class="modal-title">Add Laundry</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Room</label>
                        <select name="id_kamar" id="" class="form-control">
                            <option value="">--Select Room--</option>
                            <?php $query = mysqli_query($conn, "SELECT * FROM kamar WHERE status='Terpakai'");foreach($query as $i) : ?>
                                <option value="<?=$i['id_kamar'];?>"><?=$i['no_kamar'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="text" name="waktu" value="<?=$time;?>" class="form-control" placeholder="Time..." required>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="hidden" name="type" id="type">
                        <input type="date" name="tanggal" class="form-control" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Next</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.tambah').click(function(){
            var type = $(this).attr('value');
            $('#type').val(type);
        });

        $('#form').submit(function(e){
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
                        window.location.assign('?module=add_laundry_detail');
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

    });
</script>