<?php
$monthList = array(
    '1' => 'January',
    '2' => 'February',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);
$years_start = date('Y') - 10;
?>
<div class="container-fluid">

    <div class="card bg-light">
        <div class="card-header"><h3><i class="fas fa-exchange-alt"></i> Report - <span class="small">Retaurant Transaction</span></h3></div>
        <div class="card-body pt-2 pb-2" style="min-height: 400px;max-height: 700px;">
            <?php
            if(isset($_GET['month'])){
                if($_GET['month'] == 0){
                    echo '<div class="alert alert-danger"><b>Warning</b> : Silahkan pilih bulan dengan benar</div>';
                }
            }
            ?>
            <form action="" method="GET">
                <div class="input-group col-md-4 col-sm-6 col-xs-8 ml-auto mr-3 mt-3">
                    <div class="input-group-append input-group-text"><i class="fas fa-calendar-alt"></i></div>
                    <input type="hidden" name="module" value="lap_resto">
                    <select name="month" id="" class="input-group-append form-control" style="box-shadow: none;">
                        <option value=0>Select Month</option>
                        <?php for($i=1;$i<=12;$i++) : $select = $i == $_GET['month'] ? 'selected' : ''; ?>
                            <option value="<?=$i;?>" <?=$select;?>><?=$monthList[$i];?></option>
                        <?php endfor;?>
                    </select>
                    <div class="input-group-append">
                        <select name="years" id="" type="submit" onchange="this.form.submit()" class="input-group-append form-control" style="box-shadow: none;">
                            <option value=0>Select Years</option>
                            <?php for($i=$years_start;$i < $years_start + 50;$i++) : ?>
                                <option value="<?=$i;?>"><?=$i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                </div>
            </form>

            <?php
            if(isset($_GET['month']) && isset($_GET['years'])) : 
                if($_GET['month'] !== 0) : 
                    $month = $_GET['month'];
                    $years = $_GET['years'];
                    $query = mysqli_query($conn, "SELECT pesanan.*, pesanan_detail.*, menu.* FROM pesanan, pesanan_detail, menu WHERE month(tanggal) = '$month' && year(tanggal) = '$years' && pesanan_detail.id_pesanan=pesanan.id_pesanan && menu.id_menu=pesanan_detail.id_menu");

                    if(mysqli_num_rows($query) > 0){
            ?>

            <a href="template/cetak.php?cetak=transaksi_resto&month=<?=$month;?>&years=<?=$years;?>" target="_blank" class="btn btn-secondary float-right mt-3 mb-4 mr-5"><i class="fas fa-print"></i> Cetak</a>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date Transaction</th>
                            <th>Produk / Service</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($query as $i) : ?>
                        <tr>
                            <td><?=$i['tanggal'];?></td>
                            <td><?=$i['nama_menu'];?></td>
                            <td>Rp. <?=number_format($i['harga_menu'], 0, ',', '.');?></td>
                            <td><?=$i['qty'];?></td>
                            <td><?=number_format($i['harga_menu'] * $i['qty'], 0, ',', '.');?></td>
                        </tr>
                        <?php endforeach;?> 
                        <?php $query = mysqli_query($conn, "SELECT SUM(total) as total FROM transaksi_resto");$total = mysqli_fetch_array($query);?>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th colspan="3" class="border-top bg-white"></th>
                            <th class="border bg-white">Total Income</th>
                            <th class="border bg-white">Rp. <?=number_format($total['total'], 0, ',', '.');?></th>
                        </tr>
                    </tfooter>
                </table>    
            </div>

            <?php } else { ?>
                <div class="table-responsive">
                    <center><img src="assets/img/empty_cart.jpg" class="mt-md-5 nt-sm-3" alt=""></center>
                </div>
            <?php } endif;endif;?>

        </div>
        <div class="card-footer text-muted text-center">
            Copyright&copy 2019 | System Informasi Managemen Perhotelan<br>
            Web Development By : Mirza Dwiyan Saputra
        </div>
    </div>

</div>