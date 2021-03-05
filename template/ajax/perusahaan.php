<?php
include '../../config/database.php';
$query = mysqli_query($conn, "SELECT * FROM perusahaan");
$i = mysqli_fetch_array($query);
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3><i class="fas fa-building pr-3"></i> Company - <span class="small">Edit Company</span></h3></div>
        <div class="card-body">
            <form action="proses/ubah_perusahaan.php" method="post" id="form">
                <input type="hidden" name="id" value="<?=$i['id_perusahaan'];?>">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Hotel Name</label>
                            <input type="text" class="form-control" name="nama_hotel" value="<?=$i['nama_hotel'];?>" placeholder="Hotel Name...">
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="nama_perusahaan" value="<?=$i['nama_perusahaan'];?>" placeholder="Company Name...">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" class="form-control" name="website" value="<?=$i['website'];?>" placeholder="Website...">
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" class="form-control" name="email" value="<?=$i['email'];?>" placeholder="E-Mail">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" class="form-control" name="no_telp" value="<?=$i['no_telp'];?>" placeholder="No. Telp">
                        </div>
                        <div class="form-group">
                            <label>No. Fax</label>
                            <input type="text" class="form-control" name="no_fax" value="<?=$i['no_fax'];?>" placeholder="No. Fax">
                        </div>
                        <div class="form-group border px-3 pb-3">
                            <label>Addres</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jalan" value="<?=$i['jalan'];?>" placeholder="Jalan...">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="no_jalan" value="<?=$i['no_jalan'];?>" placeholder="No.">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kecamatan" value="<?=$i['kecamatan'];?>" placeholder="District...">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kabupaten" value="<?=$i['kabupaten'];?>" placeholder="Regency / City...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-4">
                        <a href="?module=dashboard" class="btn btn-danger">Cancel</a>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>