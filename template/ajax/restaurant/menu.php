<?php
include '../../../config/database.php';
$query = mysqli_query($conn, "SELECT * FROM menu");
$cek = mysqli_num_rows($query);
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3><i class="fas fa-utensils pr-2 pl-2"></i> Menu - <span class="small">Menu Restaurant</span></h3></div>
        <div class="card-body">
            <button class="btn btn-primary tambah" data-toggle="modal" data-target="#modalTampil"><i class="fas fa-plus"></i> Add Menu</button>
            <br>
            <br>
            <div class="row">
                <?php foreach($query as $menu) : ?>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                        <div class="card border-top-2-primary">
                        <div class="img-thumbnail mt-3 mx-auto" style="width: 100px;height: 100px;overflow: hidden;">
                            <img src="assets/img/menu/<?=$menu['img_menu'];?>" alt="" height="125" style="margin: -17px;margin-top: -19px">
                        </div>
                        <div style="width: 90%" class="mx-auto mt-2 pb-3">
                            <h5 class="text-center"><?=$menu['nama_menu'];?></h5>
                            <span class="text-muted">
                                Price : Rp. <?=number_format($menu['harga_menu'], 0, ',', '.');?><br>
                                Kategori : <?=$menu['kategori'];?>
                                <div class="navbar float-right m-0 p-0" style="margin-top: -165px!important;margin-right: -10px!important">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" style="display: block;padding: 3px 10px;" role="button" id="dropDownMenu" aria-haspopup="true" aria-expanded="false"><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i><i style="display: block;background: #888; width: 5px; height: 5px;border-radius: 50%;margin-top: 3px"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="width: 205px!important;padding: 10px;text-align: center" aria-labelledby="dropDownMenu">
                                            <button class="btn btn-danger hapus" value="<?=$menu['id_menu'];?>"><i class="fas fa-trash-alt"></i> Delete</button>
                                            <button class="btn btn-primary ubah" value="<?=$menu['id_menu'];?>" data-toggle="modal" data-target="#modalTampil"><i class="fas fa-edit"></i> Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </div>
                        </div>
                    </div>
                <?php endforeach;?>
                <?php if($cek == 0) : ?>
                <div class="mx-auto mt-5" style="width: 200px;">
                    <img src="assets/img/empty_cart.jpg" alt="" width="100%">
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="card-footer small text-muted text-center">Copyright&copy 2019 | System Manajemen Perhotelan</div>
    </div>

</div>

<!--modal tambah menu-->
<div class="modal fade" id="modalTampil" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/tambah_menu.php" method="post" id="formTambahMenu" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><i class="fas fa-utensils"></i> Tambah Menu</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name Menu</label>
                        <input type="text" class="form-control" id="nama" name="nama_menu" placeholder="Nama Menu..." required>
                    </div>
                    <div class="form-group">
                        <label>Price Menu</label>
                        <input type="text" class="form-control" id="harga" name="harga_menu" placeholder="Harga Menu..." required>
                        <i class="ml-2 text-muted small">*Masukkan Angka tanpa tanda titik(.). Exp : 90000</i>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="makanan">Food</option>
                            <option value="minuman">Drink</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Images Menu</label>
                        <img src="assets/img/blank_images.svg" class="d-block" alt="" width="120" id="imgPreview">
                        <input type="file" class="form-control-file" name="gambar_menu" id="upload" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="modalButton"><i class="fas fa-paper-plane"> Add</i></button>
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
                    document.getElementById('imgPreview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#upload').change(function(){
            imgPreview(this);
        })

    });
</script>