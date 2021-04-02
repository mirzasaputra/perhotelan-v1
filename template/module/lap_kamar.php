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
        <div class="card-header"><h3><i class="fas fa-exchange-alt"></i> Report - <span class="small">Room Transaction</span></h3></div>
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
                    <input type="hidden" name="module" value="lap_kamar">
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
                    $query = mysqli_query($conn, "SELECT * FROM transaksi_kamar WHERE month(tanggal) = '$month' && year(tanggal) = '$years'");

                    if(mysqli_num_rows($query) > 0){
            ?>

            <a href="template/cetak.php?cetak=transaksi_kamar&month=<?=$month;?>&years=<?=$years;?>" target="_blank" class="btn btn-secondary float-right mt-3 mb-4 mr-5"><i class="fas fa-print"></i> Cetak</a>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date Transaction</th>
                            <th>No. Invoice</th>
                            <th>Total Cost</th>
                            <th>DP Cast</th>
                            <th>DP Transfer</th>
                            <th>DP EDC</th>
                            <th>Paid Cash</th>
                            <th>Paid Transfer</th>
                            <th>Paid EDC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;foreach($query as $i) : ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$i['tanggal'];?></td>
                            <td><?=$i['no_invoice'];?></td>
                            <td>Rp. <?=number_format($i['total'], 0, ',', '.');?></td>
                            <td><?=($i['metode_deposit'] == 'cash') ? 'Rp. '. number_format($i['deposit'], 0, ',', '.') : '';?></td>
                            <td><?=($i['metode_deposit'] == 'transfer') ? 'Rp. '. number_format($i['deposit'], 0, ',', '.') : '';?></td>
                            <td><?=($i['metode_deposit'] == 'EDC') ? 'Rp. '. number_format($i['deposit'], 0, ',', '.') : '';?></td>
                            <td><?=($i['metode_pembayaran'] == 'cash') ? 'Rp. '. number_format($i['bayar'], 0, ',', '.') : '';?></td>
                            <td><?=($i['metode_pembayaran'] == 'transfer') ? 'Rp.'. number_format($i['bayar'], 0, ',', '.') : '';?></td>
                            <td><?=($i['metode_pembayaran'] == 'EDC') ? 'Rp.'. number_format($i['bayar'], 0, ',', '.') : '';?></td>
                        </tr>
                        <?php endforeach;?> 
                        <?php $query = mysqli_query($conn, "SELECT SUM(total) as total FROM transaksi_kamar");$total = mysqli_fetch_array($query);?>
                        <?php $query = mysqli_query($conn, "SELECT SUM(deposit) as deposit FROM transaksi_kamar WHERE metode_deposit='cash'");$deposit_cash = mysqli_fetch_array($query);?>
                        <?php $query = mysqli_query($conn, "SELECT SUM(deposit) as deposit FROM transaksi_kamar WHERE metode_deposit='transfer'");$deposit_tf = mysqli_fetch_array($query);?>
                        <?php $query = mysqli_query($conn, "SELECT SUM(deposit) as deposit FROM transaksi_kamar WHERE metode_deposit='EDC'");$deposit_edc = mysqli_fetch_array($query);?>
                        <?php $query = mysqli_query($conn, "SELECT SUM(bayar) as bayar FROM transaksi_kamar WHERE metode_pembayaran='cash'");$bayar_cash = mysqli_fetch_array($query);?>
                        <?php $query = mysqli_query($conn, "SELECT SUM(bayar) as bayar FROM transaksi_kamar WHERE metode_pembayaran='transfer'");$bayar_tf = mysqli_fetch_array($query);?>
                        <?php $query = mysqli_query($conn, "SELECT SUM(bayar) as bayar FROM transaksi_kamar WHERE metode_pembayaran='EDC'");$bayar_edc = mysqli_fetch_array($query);?>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th colspan="2" class="border-top bg-white"></th>
                            <th class="border bg-white">Total Income</th>
                            <th class="border bg-white">Rp. <?=number_format($total['total'], 0, ',', '.');?></th>
                            <th class="border bg-white">Rp. <?=number_format($deposit_cash['deposit'], 0, ',', '.');?></th>
                            <th class="border bg-white">Rp. <?=number_format($deposit_tf['deposit'], 0, ',', '.');?></th>
                            <th class="border bg-white">Rp. <?=number_format($deposit_edc['deposit'], 0, ',', '.');?></th>
                            <th class="border bg-white">Rp. <?=number_format($bayar_cash['bayar'], 0, ',', '.');?></th>
                            <th class="border bg-white">Rp. <?=number_format($bayar_tf['bayar'], 0, ',', '.');?></th>
                            <th class="border bg-white">Rp. <?=number_format($bayar_edc['bayar'], 0, ',', '.');?></th>
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