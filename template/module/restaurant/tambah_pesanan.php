<div class="container fluid">

    <div class="col-md-5 col-sm-8 col-xs-12 bg-light rounded-lg mx-auto mt-5 shadow">
        <form action="proses/tambah.php?tambah_pelanggan" method="post" id="tambah">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-users"></i> Add Customer</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Guest Name</label>
                    <input type="hidden" name="tambah_pelanggan">
                    <select name="id_transaksi" class="form-control">
                        <option value="false">--Select Guest--</option>
                        <?php $query=mysqli_query($conn, "SELECT transaksi_kamar.*, tamu.* FROM transaksi_kamar, tamu WHERE transaksi_kamar.status='check in' && tamu.id_tamu=transaksi_kamar.id_tamu");foreach($query as $a) : ?>
                            <option value="<?=$a['id_transaksi_kamar'];?>"><?=$a['prefix'] . ". " . $a['nama_depan'] . " " . $a['nama_belakang'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>No. Meja</label>
                    <?php 
                        $query=mysqli_query($conn, "SELECT * FROM meja WHERE status='kosong' ORDER BY kd_meja ASC");
                        if(mysqli_num_rows($query) <= 0){ ?>
                                <div class="alert alert-danger small">Sorry, table is full</div>
                                <div class="modal-footer">
                    <?php  } else { ?>
                    <select name="id_meja" class="form-control">
                        <option value="false">--Select Table--</option>
                        <?php foreach($query as $i) : ?>
                            <option value="<?=$i['id_meja'];?>"><?=$i['kd_meja'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <a href="?module=dashboard" class="btn btn-danger">Cancel</a>
                <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Next</button>
                <?php } ?>
            </div>
        </form>
    </div>

</div>

<script>
    $(document).ready(function(){

        $('#tambah').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.hasil == true){
                        window.location.assign('?module=restaurant/produk');
                    } else {
                        swal({
                            title: "Failed",
                            icon: "error",
                            text: data.pesan
                        });
                    }
                }
            });
        });

    });
</script>