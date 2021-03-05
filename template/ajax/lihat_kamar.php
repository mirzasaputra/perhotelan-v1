<?php
session_start();
include "../../config/database.php";

$user = $_SESSION["user"];
$pass = $_SESSION["pass"];
$data_user = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' && password ='$pass'");
$data_user = mysqli_fetch_array($data_user);
$query = mysqli_query($conn, "SELECT kamar.*, tipe_kamar.* FROM kamar, tipe_kamar");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Room <span class="small">- Room Information</span></h3></div>
        <div class="card-body">
            <button class="btn btn-primary <?php if($data_user['level'] !== 'Super Admin'){echo 'd-none';}?>" data-target="#modal-tambah" data-toggle="modal"><i class="fas fa-plus"></i> Add Room</button>
            <br>
            <br>
            <div class="table-responsive">
            <table class="table bordered table-hovered">
                <tr>
                    <th>No.</th>
                    <th>No. Room</th>
                    <th>Room Type</th>
                    <th>Max. Adult</th>
                    <th>Max. Children</th>
                    <th>Statuse</th>
                    <th>Action</th>
                </tr>
                <?php
                if(mysqli_num_rows($query)>0){
                    $no = 1;while($i=mysqli_fetch_array($query)) :
                ?>
                    <tr>
                        <td><?=$no++.'.';?></td>
                        <td><?=$i['no_kamar'];?></td>
                        <td><?=$i['tipe_kamar'];?></td>
                        <td><?=$i['max_dewasa'];?></td>
                        <td><?=$i['max_anak'];?></td>
                        <td><?php if($i['status'] == "Tersedia"){ ?>
                            <div class="badge badge-success p-2">Available</div>
                            <?php } elseif($i['status'] == "Terpakai"){ ?>
                            <div class="badge badge-danger p-2">Used</div>
                            <?php } else { ?>
                            <div class="badge badge-warning p-2">Dirty</div>
                            <?php } ?>
                        </td>
                        <td><button class="btn btn-danger hapus <?php if($data_user['level'] !== 'Super Admin'){echo 'd-none';}?>" value="<?=$i['id_kamar'];?>"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn btn-primary edit" value="<?=$i['id_kamar'];?>" data-target="#modal-editData" data-toggle="modal"><i class="fas fa-edit"></i></button></td>
                    </tr>
                <?php
                    endwhile;
                } else {
                ?>
                <tr>
                    <td colspan='7'><div class="alert alert-danger">Room not available, <a href="#modal-tambah" data-toggle="modal">Add</a>.</div></td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </div>

</div>

<!--modal tambah-->
<div class="modal fade" id="modal-tambah" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/tambah_kamar.php" method="post" id="formTambah">

                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fas fa-plus"></i> Add Room</h5>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>No. Room</label>
                        <input type="text" class="form-control" name="no_kamar" placeholder="No. Kamar" required>
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
                                <input type="number" class="form-control" name="max_dewasa" placeholder="Max. Adult" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Max. Children</label>
                                <input type="number" class="form-control" name="max_anak" placeholder="Max. Children" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Add</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!--modal edit-->
<div class="modal fade" id="modal-editData" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method='post' id="modalEdit">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Data</h5>
                    <button class="close" data-dismiss='modal'>&times;</button>
                </div>
                <div class="modal-body">
                    <div id="viewEditKamar"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss='modal'>Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i>Edit Data</button>
                </div>

        </div>
    </div>
</div>