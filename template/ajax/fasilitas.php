<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light ">
        <div class="card-header"><h4>Fasilitas Room</h4></div>
        <div class="card-body">
            <button class="btn btn-primary" data-target="#modal-tambah" data-toggle="modal"><i class="fas fa-plus"></i> Add Data</button>
            <br>
            <br>
            <div class="table-responsive">
            <table class="table bordered table-hovered">
                <tr>
                    <th>No.</th>
                    <th>Fasilitas</th>
                    <th>Action</th>
                </tr>
                <?php
                include "../../config/database.php";
                $query = mysqli_query($conn, "SELECT * FROM fasilitas");
                if(mysqli_num_rows($query)>0){
                    $no=1;while($i=mysqli_fetch_array($query)) :
                ?>
                <tr>
                    <td width="1%"><?=$no++?></td>
                    <td><?=$i['fasilitas_name'];?></td>
                    <td width="20%"><button class="btn btn-danger hapus" value="<?=$i['id'];?>"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn btn-primary edit" data-target="#modal-edit" data-toggle="modal" value="<?=$i['id'];?>"><i class="fas fa-edit"></i></button></td>
                </tr>
                    <?php endwhile; } else { ?>
                <tr>
                    <td colspan="5"><div class="alert alert-danger">Fasilitas is not available, <a href="#modal-tambah" data-toggle="modal">Add</a>.</div></td>
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
            <form action="proses/fasilitas.php?tambah" method="post" id="formTambah">

                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fas fa-plus"></i> Add Data</h5>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fasilitas Name</label>
                        <input type="text" class="form-control" name="fasilitas" placeholder="Fasilitas Name..." required autocomplete="off">
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
            <form action="proses/fasilitas.php?edit" method="post" id="formEdit">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Data</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="modal-edit-fasilitas"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Edit Data</button>
                </div>

            </form>
        </div>
    </div>
</div>