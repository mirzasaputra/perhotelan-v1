<?php
include "../../../config/database.php";
$query = mysqli_query($conn, "SELECT * FROM user WHERE status='petugas resto'");
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3><i class="fas fa-user"></i> Officer - <span class="small">Restaurant Officer</span></h3></div>
        <div class="card-body">
            <button class="btn btn-primary tambah" data-target="#myModal" data-toggle="modal"><i class="fas fa-plus"></i> Add Petugas</button>
            <br>
            <br>

            <div class="row">
                <?php while($i=mysqli_fetch_array($query)) : ?>
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card border shadow border-top-2-primary p-2">
                            <div class="img-thumbnail mx-auto mt-2" style="width: 100px;height: 100px;overflow: hidden;">
                                <img src="assets/img/<?=$i['image'];?>" alt="" height="125" style="margin: -17px;margin-top: -19px">
                            </div>
                            <div style="width: 90%" class="mx-auto mt-2 pb-3">
                                <h5 class="text-center"><?=$i['nama_user'];?></h5>
                                <span class="text-muted small">
                                    Username : <?=$i['username'];?><br>
                                    Password : <?=$i['password'];?><br>
                                    Level : <?=$i['level'];?><br>
                                    No. Telp/Hp : <?=$i['no_telp'];?>
                                    <div class="navbar float-right m-0 p-0" style="margin-top: -210px!important;margin-right: -10px!important">
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" style="display: block;padding: 3px 10px;" role="button" id="dropDownMenu" aria-haspopup="true" aria-expanded="false"><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="width: 205px!important;padding: 10px;text-align: center" aria-labelledby="dropDownMenu">
                                                <button class="btn btn-danger hapus" value="<?=$i['id_user'];?>"><i class="fas fa-trash-alt"></i> Delete</button>
                                                <button class="btn btn-primary ubah" value="<?=$i['id_user'];?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i> Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
        <div class="card-footer text-muted text-center small">Copyright&copy 2019 | System Manajemen Perhotelan</div>
    </div>

</div>

<!--modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="formModal" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama..." required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user" class="form-control" id="username" placeholder="Username..." required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="hidden" name="passLama" id="passLama">
                        <input type="password" name="pass" class="form-control" id="pass" placeholder="Password..." required>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="Admin Resto">Admin</option>
                            <option>Kasir</option>
                            <option>Waiter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. Telp/Hp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp/Hp" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <img src="assets/img/blank_images.svg" width="120" alt="" class="d-block mb-2" id="imgPreview">
                        <input type="file" class="form-control-file" name="image" id="upload">
                        <input type="hidden" id="gambarLama" name="gambarLama">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="modal-submit" type="submit"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        function imgPreview(input){
            if(input.files){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#imgPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#upload').change(function(){
            imgPreview(this);
        })

    });
</script>