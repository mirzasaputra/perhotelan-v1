<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light ">
        <div class="card-header"><h4>Room Type</h4></div>
        <div class="card-body">
            <button class="btn btn-primary" data-target="#modal-tambah" data-toggle="modal"><i class="fas fa-plus"></i> Add Data</button>
            <br>
            <br>
            <div class="table-responsive">
            <table class="table bordered table-hovered">
                <tr>
                    <th>No.</th>
                    <th>Type</th>
                    <th>Price / Night</th>
                    <th>Price / People</th>
                    <th>Action</th>
                </tr>
                <?php
                include "../../config/database.php";
                $query = mysqli_query($conn, "SELECT * FROM tipe_kamar");
                if(mysqli_num_rows($query)>0){
                    $no=1;while($i=mysqli_fetch_array($query)) :
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$i['tipe_kamar'];?></td>
                    <td>Rp. <?=number_format($i['harga_per_mlm'], 0, ',', '.');?></td>
                    <td>Rp. <?=number_format($i['harga_per_org'], 0, ',', '.');?></td>
                    <td><button class="btn btn-danger hapus" value="<?=$i['id_tipe_kamar'];?>"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn btn-primary edit" data-target="#modal-edit" data-toggle="modal" value="<?=$i['id_tipe_kamar'];?>"><i class="fas fa-edit"></i></button></td>
                </tr>
                    <?php endwhile; } else { ?>
                <tr>
                    <td colspan="5"><div class="alert alert-danger">Room Type is available, <a href="#modal-tambah" data-toggle="modal">Add</a>.</div></td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="modal-tambah" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/tambah_tipe_kamar.php" method="post" id="formTambah">

                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fas fa-plus"></i> Add Data</h5>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Room Type</label>
                        <input type="text" class="form-control" name="tipe_kamar" placeholder="Room Type..." required>
                    </div>
                    <div class="form-group">
                        <label>Price / Night</label>
                        <input type="number" class="form-control" name="harga_per_mlm" placeholder="Price / Night" required>
                        <i class="small text-secondary ml-3">*Enter number without periods(.) exp : 100000</i>
                    </div>
                    <div class="form-group">
                        <label>Price / People</label>
                        <input type="number" class="form-control" name="harga_per_org" placeholder="Price / People" required>
                        <i class="small text-secondary ml-3">*Enter number without periods(.) exp : 100000</i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-info" type="submit"><i class="fas fa-paper-plane"></i> Add</button>
                </div>
            
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/edit.php" method="post" id="formEdit">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Data</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="modal-edit-tipeKamar"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Edit Data</button>
                </div>

            </form>
        </div>
    </div>
</div>