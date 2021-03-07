<?php
$query = mysqli_query($conn, "SELECT transaksi_kamar.*, tamu.*, kamar.* FROM transaksi_kamar, tamu, kamar WHERE tamu.id_tamu=transaksi_kamar.id_tamu && kamar.id_kamar=transaksi_kamar.id_kamar && transaksi_kamar.status='check in'");
?>
<div class="container-fluid">

    <div class="card bg-light">
        <div class="card-header"><h3><i class="fas fa-bed"></i> Room - <span class="small">Select the room that will make the order</span></h3></div>
        <div class="card-body">
            <?php if(mysqli_num_rows($query) > 0){ ?>
            <div class="row">
                <?php foreach($query as $i) : ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 mb-3    ">
                        <div class="card bg-primary">
                            <div class="card-body-icon"><i class="fas fa-bed"></i></div>
                            <div class="card-body text-white">
                                <h3>No. <?=$i['no_kamar'];?></h3>
                                <span><?=$i['prefix'] . ' ' . $i['nama_depan'] . ' ' . $i['nama_belakang'];?></span>
                            </div>
                            <a href="" value="<?=$i['id_transaksi_kamar'];?>" class="card-footer clearfix z-1 p-1 text-center text-white pelanggan">Masukkan Pesanan</a>
                        </div>
                    </div>              
                <?php endforeach;?>
            </div>
            <?php } else { ?>
                <center><img src="assets/img/empty_cart.jpg" alt=""></center>
            <?php } ?>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){

        $('.pelanggan').click(function(e){
            let id = $(this).attr('value');
            e.preventDefault();
            $.ajax({
                url: "proses/tambah.php?id_transaksi="+id+"&tambah_pelanggan",
                dataType: 'json',
                success: function(data){
                    if(data.hasil == true){
                        // window.location.assign('?module=restaurant/produk');
                    } else {
                        swal({
                            title: 'Failed',
                            icon: 'error',
                            text: data.pesan
                        });
                    }
                }
            })
        })

    })
</script>