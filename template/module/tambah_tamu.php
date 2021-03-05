<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item tamu"><a href="?module=tamu">Guest</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light border-top-2-primary">
        <div class="card-header"><h4><i class="fas fa-suitcase"></i> Add Guest</h4></div>
        <div class="card-body">
            <form action="proses/tambah_tamu.php" method="post" id="formTambahTamu">

                <div class="row">
                
                    <div class="col-sm-6 pr-md-5 pr-sm-0">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Prefix</label>
                                    <select name="prefix" class="form-control">
                                        <option>Mr</option>
                                        <option>Ms</option>
                                        <option>Mrs</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="nama_depan" placeholder="First Name..." required>
                                </div>
                                <div class="col-sm-5">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="nama_blkg" placeholder="Last Name..." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Identity Type</label>
                                    <select name="tipe_identitas" class="form-control">
                                        <option>KTP</option>
                                        <option>SIM</option>
                                        <option>Pasport</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                    <label>No. Identity</label>
                                    <input type="text" class="form-control" name="no_identitas" placeholder="No. Identitas" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="warga_negara" placeholder="Country..." required>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-md-5 pl-sm-0">
                        <div class="form-group border px-3 pb-3">
                            <label>Addres</label>
                            <div class="form-group">
                                <div class="row">    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jalan" placeholder="Jalan" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="no_jalan" placeholder="No">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="kabupaten" placeholder="Regency / City" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="provinsi" placeholder="Province" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No. Telp / Hp</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="No. Telp / Hp" required>
                        </div>
                    </div>
                
                </div>
                <br>
                <div class="form-group">
                    <a href="?module=tamu" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-primary ml-md-2 ml-sm-0"><i class="fas fa-paper-plane"></i> Add Tamu</button>
                </div>
            
            </form>
        </div>
    </div>

</div>
<?php if($_GET['module'] == 'tambah_tamu') : ?>

<script>
    $(document).ready(function(){
        $('#formTambahTamu').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.hasil == true){
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: data.pesan
                        }).then(function(){
                            window.location.assign('?module=tamu');
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
    })
</script>
<?php endif;?>