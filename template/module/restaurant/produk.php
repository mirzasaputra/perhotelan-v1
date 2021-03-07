<?php
$per_halaman = 4;
if(isset($_GET['makanan'])){
    $jumlah = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='makanan'");
}
elseif(isset($_GET['minuman'])){
    $jumlah = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='minuman'");
} else {
    $jumlah = mysqli_query($conn, "SELECT * FROM menu");
}
$record = mysqli_num_rows($jumlah);
$halaman = ceil($record / $per_halaman);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_halaman;
?>
<div class="container-fluid">

    <div class="row">

        <div class="col-md-7 col-sm-12 col-xs-12 mb-3">
            <div class="card bg-light">
                <div class="card-header"><h4><i class="fas fa-utensils"></i> Latest Menu</h4></div>
                <div class="card-body">
                <nav class="navbar navbar-default navbar-expand navbar-static-top border mb-3 p-0">
                    <ul class="navbar-nav d-inline-block">
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link toggle px-4 border-right text-dark" aria-haspopup="true" aria-expanded="false"><strong>Kategori </strong><i class="fas fa-list mt-1 ml-2"></i></a>
                            <div class="dropdown-menu">
                                <a href="?module=restaurant/produk&makanan" class="dropdown-item border-bottom">Food</a>
                                <a href="?module=restaurant/produk&minuman" class="dropdown-item">Drink</a>
                            </div>
                        </li>
                    </ul>
                </nav>
                    <div class="row">
                        <?php
                        if(isset($_GET['minuman'])){
                            $query = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='minuman' ORDER BY nama_menu DESC LIMIT $start, $per_halaman");
                        }
                        elseif(isset($_GET['makanan'])){
                            $query = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='makanan' ORDER BY nama_menu DESC LIMIT $start, $per_halaman");
                        } else {
                            $query = mysqli_query($conn, "SELECT * FROM menu ORDER BY nama_menu DESC LIMIT $start, $per_halaman");
                        }
                        foreach($query as $i) : 
                        ?>
                        <div class="col-sm-6 mb-4">
                            <div class="card border-top-2-primary">
                                <div class="img-thumbnail mx-auto mt-2 mb-2" style="width: 100px;height: 100px;overflow: hidden">
                                    <img src="assets/img/menu/<?=$i['img_menu'];?>" alt="" height="120" style="margin: -15px;">
                                </div>
                                <div style="font-family: courier new">
                                    <h4 class="text-center"><?=$i['nama_menu'];?><br><span class="small text-muted">Rp. <?=number_format($i['harga_menu'], 0, ',', '.');?></span></h4>
                                </div>
                                <a href="#myModal" data-toggle="modal" value="<?=$i['id_menu'];?>" class="card-footer clearfix text-center z-1 p-1 pesan">Order</a>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <ul class="pagination">
                        <li class="page-link <?php if(empty($_GET['page'])){echo 'd-none';}?>"><a href="?module=restaurant/produk&<?php if(isset($_GET['page'])){ echo "page=" . $_GET['page'] - 1;}?>" class="nav-link p-0"><</a></li> 
                        <?php for($i=1;$i<=$halaman;$i++) : ?>
                            <li class="page-link"><a class="nav-link p-0" href="?module=restaurant/produk&page=<?=$i;?>"><?=$i;?></a></li>
                        <?php endfor;?>
                        <li class="page-link <?php if(isset($_GET['page'])){if($_GET['page'] == $halaman){echo 'd-none';}}if($halaman == 1 | $halaman == 0){echo 'd-none';}?>"><a href="?module=restaurant/produk&page=<?php if(isset($_GET['page'])){echo $_GET['page'] + 1;}else{echo 2;}?>" class="nav-link p-0">></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12 col-xs-12 mb-3">
            <div id="viewDataPesanan"></div>
        </div>

    </div>

</div>

<script>
    $(document).ready(function(){

        loadData_pesan();

        function loadData_pesan(){

            $.get('template/ajax/restaurant/list_pesanan.php', function(data){
                $('#viewDataPesanan').html(data);

                $('.hapus').click(function(){
                    let id = $(this).attr('value');
                    $.ajax({
                        url: 'proses/hapus.php?id='+id+'&hapus=pesanan_detail',
                        dataType: 'json',
                        success: function(data){
                            if(data.hasil == true){
                                 loadData_pesan();
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

                $('#formPesan').submit(function(e){
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
                                $('#myModal').modal('hide');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                                loadData_pesan();
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

                $('.konfirm').click(function(){
                    let id = $(this).attr('value');
                    $.ajax({
                        url: 'proses/edit.php?id='+id+'&modal=update_pesanan',
                        dataType: 'json',
                        success: function(data){
                            if(data.hasil == true){
                                swal({
                                    title: 'Success',
                                    icon: 'success',
                                    text: data.pesan
                                }).then(function(){
                                    window.location.assign('<?=$_SESSION['url'];?>');
                                });
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

            });

            $('.pesan').click(function(){
                let id = $(this).attr('value');
                $.ajax({
                    url: "template/ajax/restaurant/ubah.php?id="+id+"&pesanan",
                    dataType: "json",
                    success: function(data){
                        $('#nama').val(data.nama_menu);
                        $('#harga').val(data.harga_menu);
                        $('#formPesan').attr('action', 'proses/tambah.php?id='+id+'&pesanan');
                    }
                })
            });

        }

    });
</script>