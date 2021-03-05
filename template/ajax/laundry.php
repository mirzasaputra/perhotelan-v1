<?php 
session_start();
include '../../config/database.php';

$per_hal = 10;
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $record = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM laundry, kamar WHERE laundry.status!='Input laundry' && kamar.id_kamar=laundry.id_kamar && laundry.status LIKE '%" . $cari . "%' OR kamar.no_kamar LIKE '%" . $cari . "%'");
} else {
    $cari = '';
    $record = mysqli_query($conn, "SELECT * FROM laundry WHERE status!='Input laundry'");
}
$jumlah = mysqli_num_rows($record);
$halaman = ceil($jumlah / $per_hal);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;

$no = 1;
?>

<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Laundry - <span class="small">List Laundry</span></h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-md-7 mb-3">
                    <a href="?module=add_laundry" class="btn btn-primary"><i class="fas fa-plus"></i> Add Laundry</a>
                    <button class="btn btn-primary mt-2 mt-md-0 <?php if($_SESSION['get'] == 'Laundry'){echo 'd-none';}?>" data-toggle="modal" data-target="#myModalSet"><i class="fas fa-pencil-alt"></i> Set</button>
                </div>
                <div class="col-sm-6 col-md-5 mb-3 pl-md-5">
                    <form action="" method="get">
                        <div class="input-group float-md-right">
                            <input type="hidden" name="module" value="laundry">
                            <input type="text" name="cari" style="box-shadow: none!important" class="form-control" placeholder="Enter Keywords..." value="<?=$cari;?>" required>
                            <div class="input-group-append">
                                <button class="btn btn-dark" style="box-shadow: none!important" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <?php 
                    if(isset($_GET['cari'])){
                        $query = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM laundry, kamar WHERE laundry.status!='Input laundry' && kamar.id_kamar=laundry.id_kamar && laundry.status LIKE '%" . $cari . "%' OR kamar.no_kamar LIKE '%" . $cari . "%' ORDER BY laundry.id_laundry DESC LIMIT $start, $per_hal");
                        echo "<p>Search result of <b>" . $cari . "</b>";
                    } else {
                        $query = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM laundry, kamar WHERE laundry.status!='Input laundry' && kamar.id_kamar=laundry.id_kamar ORDER BY laundry.id_laundry DESC LIMIT $start, $per_hal");
                    }
                ?>
                <?php if(mysqli_num_rows($query) > 0){ ?>
                <table class="table table-hovered table-bordered text-muted">
                    <thead>
                        <tr>
                            <td width="1%">No.</td>
                            <td>Room</td>
                            <td>Date</td>
                            <td>Total</td>
                            <td>Statuse</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach($query as $i) : ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$i['no_kamar'];?></td>
                            <td><?=$i['waktu'] . ' | ' . $i['tanggal'];?></td>
                            <td>Rp. <?=number_format($i['total'], 0, ',', '.');?></td>
                            <td><span class="badge badge-warning text-white small"><?=$i['status'];?></span></td>
                            <td><a class="btn btn-info" href="?module=viewLaundry&id=<?=$i['id_laundry'];?>"><i class="fas fa-edit"></i> View</a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>

                    <?php
                    if(isset($_GET['cari'])){

                    } else { 
                        $total = mysqli_query($conn, "SELECT SUM(total) as total FROM laundry");
                        $total = mysqli_fetch_array($total);
                    ?>

                    <tfoot>
                        <tr>
                            <td colspan="4" class="border-0"></td>
                            <td>Total</td>
                            <td>Rp. <?=number_format($total['total'], 0, ',', '.');?></td>
                        </tr>
                    </tfoot>
                    <?php } ?>

                </table>
                <?php } else { ?>
                    <center><img src="assets/img/empty_cart.jpg" alt=""></center>
                <?php } ?>

                <!--pagination-->
                <ul class="pagination ml-4">
                    <?php for($i = 1;$i<=$halaman;$i++) : ?>
                        <li class="page-link"><a href="?page=<?=$i;?>"><?=$i;?></a></li>
                    <?php endfor;?>
                </ul>
            </div>
        </div>
        <div class="card-footer text-muted small text-center">Copyright&copy 2019 | System Manajemen Perhotelan</div>
    </div>

</div>

<!--Modal Set Harga-->
<div class="modal fade" id="myModalSet" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/edit_jenis_laundry.php" method="post" id="formSet">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> Set Price</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                
                    <div id="viewDataTab"></div>
                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>