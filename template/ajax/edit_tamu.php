<?php
include "../../config/database.php";
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tamu WHERE id_tamu='$id'");
$i = mysqli_fetch_array($query);
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item tamu"><a href="?module=tamu">Guest</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light border-top-2-primary">
        <div class="card-header"><h4><i class="fas fa-edit"></i> Edit Guest</h4></div>
        <div class="card-body">
            <form action="proses/edit.php" method="post" id="formEditTamu">

                <div class="row">
                
                    <div class="col-sm-6 pr-md-4 pr-sm-0">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$i['id_tamu'];?>">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Prefix</label>
                                    <select name="prefix" class="form-control">
                                        <?php if($i['prefix'] == 'Mr') : ?>
                                            <option selected>Mr</option>
                                            <option>Ms</option>
                                            <option>Mrs</option>
                                        <?php endif;if($i['prefix'] == 'Ms') : ?>
                                            <option>Mr</option>
                                            <option>Ms</option>
                                            <option selected>Mrs</option>
                                        <?php endif;if($i['prefix'] == 'Mrs') : ?>
                                            <option>Mr</option>
                                            <option selected>Ms</option>
                                            <option>Mrs</option>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="nama_depan" value='<?=$i['nama_depan'];?>' placeholder="First Name" required>
                                </div>
                                <div class="col-sm-5">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="nama_blkg" value='<?=$i['nama_belakang'];?>' placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Type Identity</label>
                                    <select name="tipe_identitas" class="form-control">
                                        <?php if($i['tipe_identitas'] == 'KTP') : ?>
                                            <option>KTP</option>
                                            <option>SIM</option>
                                            <option>Pasport</option>
                                        <?php endif;if($i['tipe_identitas'] == 'SIM') : ?>
                                            <option>KTP</option>
                                            <option>SIM</option>
                                            <option>Pasport</option>
                                        <?php endif;if($i['tipe_identitas'] == 'Pasport') : ?>
                                            <option>KTP</option>
                                            <option>SIM</option>
                                            <option>Pasport</option>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                    <label>No. Identity</label>
                                    <input type="text" class="form-control" name="no_identitas" value='<?=$i['no_identitas'];?>' placeholder="No. Identity..." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="warga_negara" value='<?=$i['warga_negara'];?>' placeholder="Country" required>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-md-5 pl-sm-0">
                        <div class="form-group border px-3 pb-3">
                            <label>Address</label>
                            <div class="form-group">
                                <div class="row">    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jalan" value='<?=$i['jalan'];?>' placeholder="Jalan" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="no_jalan" value='<?=$i['no_jalan'];?>' placeholder="No">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="kabupaten" value='<?=$i['kabupaten'];?>' placeholder="Regency / City" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="provinsi" value='<?=$i['provinsi'];?>' placeholder="Province" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No. Telp / Hp</label>
                            <input type="text" class="form-control" name="no_telp" value='<?=$i['no_telp'];?>' placeholder="No. Telp / Hp" required>
                        </div>
                    </div>
                
                </div>
                <br>
                <div class="form-group">
                    <a href="?module=tamu" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-primary ml-md-2 ml-sm-0"><i class="fas fa-edit"></i> Edit Data</button>
                </div>
            
            </form>
        </div>
    </div>

</div>