<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?module=user">User</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h4><i class="fas fa-user"></i> Add User</h4></div>
        <div class="card-body">
            <form action="proses/tambah_user.php" method="post" id="formTambah" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-sm-6 pr-md-5 pr-sm-0">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="nama_user" placeholder="Nama User" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="user" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="form-control">
                                <option>Super Admin</option>
                                <option>Front Office</option>
                                <option>Laundry</option>
                                <option>Owner</option>
                                <option>Room Service</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-md-5 pl-sm-0">
                        <div class="form-group">
                            <label>Images</label>
                            <input type="file" class="form-control-file" name="image" id="upload-file">
                            <img src="assets/img/default.jpg" id="image-preview" height='95' class='pt-2'>
                        </div>
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="No. Telp" required>
                        </div>
                    </div>

                </div>
                <br>
                <br>
                <div class="row">
                    <a href="?module=user" class="btn btn-danger ml-md-5 ml-sm-0">Batal</a>
                    <button type="submit" class="btn btn-primary ml-md-2 ml-sm-0"><i class="fas fa-paper-plane"></i> Add User</button>
                </div>
                <br>

            </form>
        </div>
        <?php if(isset($_GET['tambah_user'])) : ?><div class="card-footer text-muted small"><?=$tgl->format("D, M Y").' Pukul : '.$tgl->format("H:i").' WIB.';?><?php endif;?></div>
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

        <?php if(isset($_GET['module'])) : ?>
        <?php if($_GET['module'] == 'tambah_user') : ?>
        $('#formTambah').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.hasil==true){
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: data.pesan
                        }).then(function(){
                            window.location.assign('?module=user');
                        });
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
        <?php endif;?>
        <?php endif;?>
    });
</script>