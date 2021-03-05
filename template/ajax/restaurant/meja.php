<?php
include "../../../config/database.php";
$query = mysqli_query($conn, "SELECT * FROM meja ORDER BY kd_meja ASC");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Table - <span class="small">Data table</span></h3></div>
        <div class="card-body">
            <button class="btn btn-primary tambah" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Add Table</button>
            <br><br>

            <div class="row">
                <?php while($i = mysqli_fetch_array($query)) : ?>
                <div class="col-sm-4 mb-4">
                    <div class="card bg-default border-top-2-primary">
                        <div class="card-body text-center" style="font-family: courier new;">
                            <h3><b>No. <?=$i['kd_meja'];?></b></h3>
                            Statuse : <span class="badge badge-warning p-2"><?=$i['status'];?></span><br>
                            <?php if($i['status'] == 'Kosong'){ ?>
                                <i class="text-success small">The table is empty</i>
                            <?php } else { ?>
                                <i class="text-danger small">The table is full</i>
                            <?php } ?>
                            <div class="navbar float-right m-0 p-0" style="margin-top: px!important;margin-right: -10px!important">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" style="display: block;padding: 3px 10px;" role="button" id="dropDownMenu" aria-haspopup="true" aria-expanded="false"><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="width: 225px!important;padding: 10px;text-align: center" aria-labelledby="dropDownMenu">
                                        <button class="btn btn-danger hapus" value="<?=$i['id_meja'];?>"><i class="fas fa-trash-alt"></i> Delete</button>
                                        <button class="btn btn-primary ubah" value="<?=$i['id_meja'];?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i> Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="formModal">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Number Table</label>
                        <input type="text" class="form-control" id="no_meja" name="no_meja" placeholder="No. Table" required>
                    </div>
                    <div class="form-group">
                        <label>Statuse</label>
                        <select name="status" id="statuse" class="form-control">
                            <option value="kosong">Empty</option>
                            <option value="penuh">Full</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="modal-submit"><i class="fas fa-paper-plane"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>