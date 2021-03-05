<?php
include ('../../config/database.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
$i = mysqli_fetch_array($query);
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?module=user">User</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h4><i class="fas fa-user"></i> Add User</h4></div>
        <div class="card-body">
            <form action="proses/edit.php?modal=user" method="post" id="formEditUser" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-sm-6 pr-md-5 pr-sm-0">
                        <input type="hidden" name="id_user" value="<?=$i['id_user'];?>">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="<?=$i['nama_user'];?>" name="nama_user" placeholder="Nama User" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="<?=$i['username'];?>" name="user" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="hidden" name="passLama" value="<?=$i['password'];?>">
                            <input type="password" class="form-control" value="<?=$i['password'];?>" name="pass" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="form-control">
                                <?php if($i['level'] == 'Super Admin'){ ?>
                                    <option>Super Admin</option>
                                    <option>Front Office</option>
                                    <option>Laundry</option>
                                    <option>Owner</option>
                                    <option>Room Service</option>
                                <?php } elseif($i['level'] == 'Front Office'){ ?>
                                    <option>Admin</option>
                                    <option selected>Front Office</option>
                                    <option>Laundry</option>
                                    <option>Owner</option>
                                    <option>Room Service</option>
                                <?php } elseif($i['level'] == 'Laundry'){ ?>
                                    <option>Super Admin</option>
                                    <option>Front Office</option>
                                    <option selected>Laundry</option>
                                    <option>Owner</option>
                                    <option>Room Service</option>
                                <?php } elseif($i['level'] == 'Owner'){ ?>
                                    <option>Super Admin</option>
                                    <option>Front Office</option>
                                    <option>Laundry</option>
                                    <option selected>Owner</option>
                                    <option>Room Service</option>
                                <?php } else{ ?>
                                    <option>Super Admin</option>
                                    <option>Front Office</option>
                                    <option>Laundry</option>
                                    <option>Owner</option>
                                    <option selected>Room Service</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-md-5 pl-sm-0">
                        <div class="form-group">
                            <label>Images</label>
                            <input type="hidden" name="valueImage" value="<?=$i['image'];?>">
                            <input type="file" class="form-control-file" name="image" id="upload-file">
                            <img src="assets/img/<?=$i['image'];?>" id="image-preview" height='95' class='pt-2'>
                        </div>
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" class="form-control" value="<?=$i['no_telp'];?>" name="no_telp" placeholder="No. Telp" required>
                        </div>
                    </div>

                </div>
                <br>
                <br>
                <div class="row">
                    <a href="?module=user" class="btn btn-danger ml-md-5 ml-sm-0">Cancel</a>
                    <button type="submit" class="btn btn-primary ml-md-2 ml-sm-0"><i class="fas fa-paper-plane"></i> Edit User</button>
                </div>
                <br>

            </form>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        function filePreview(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    document.getElementById('image-preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

        }

        $('#upload-file').change(function(){
            filePreview(this);
        });

    });
</script>