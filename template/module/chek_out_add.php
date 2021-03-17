<?php
$id = $_GET['id_transaksi'];
$query = mysqli_query($conn, "SELECT transaksi_kamar.*, tamu.*, kamar.*, tipe_kamar.*, transaksi_kamar_detail.* FROM transaksi_kamar, tamu, kamar, tipe_kamar, transaksi_kamar_detail WHERE transaksi_kamar.id_transaksi_kamar='$id' && tamu.id_tamu=transaksi_kamar.id_tamu && transaksi_kamar_detail.id_transaksi_kamar=transaksi_kamar.id_transaksi_kamar && kamar.id_kamar=transaksi_kamar_detail.id_kamar && tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar");
$i = mysqli_fetch_array($query);

//meghitung qty
$in = date_create($i['tgl_checkin']);
$out = date_create($i['tgl_checkout']);
$qty = date_diff($in, $out)->format('%a');
if($qty == 0){
    $qty = 1;
}

?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?module=chek_in">Select Room</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h3>Chek Out</h3></div>
        <div class="card-body">
            <form action="proses/chek_out.php?act=chek_out" method="post" id="formChekOut">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-7">
                                    <label>No. Invoice</label>
                                    <input type="hidden" name="id_transaksi_kamar" value="<?=$id;?>">
                                    <input type="hidden" name="id_kamar" value="<?=$i['id_kamar'];?>">
                                    <input type="text" class="form-control" name="no_invoice" value="<?=$i['no_invoice'];?>" readonly>
                                </div>
                                <div class="col-sm-5">
                                    <label>Guest Name</label>
                                    <input type="text" class="form-control" name="nama_tamu" value="<?=$i['prefix']. ' ' . $i['nama_depan'] . ' ' . $i['nama_belakang'];?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 pl-4">
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>The Number Of Guest</label>
                                    <input type="text" class="form-control" name="jumlah_dewasa" value="<?=$i['jumlah_dewasa'];?>" readonly>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <input type="text" class="form-control" name="jumlah_anak" value="<?=$i['jumlah_anak'];?>" readonly>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date / Time Check In</label>
                                    <input type="text" class="form-control" name="tgl_chek_in" value="<?=$i['tgl_checkin'];?>" readonly>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <input type="text" class="form-control" name="waktu_chek_in" value="<?=$i['waktu_checkin'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date / Time Check Out</label>
                                    <input type="date" class="form-control" name="tgl_chek_out" value="<?=$i['tgl_checkout'];?>">
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <label></label>
                                    <input type="text" class="form-control" name="waktu_chek_out" value="<?=$i['waktu_checkout'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                    </div>
                </div>
                

                <br>
                <br>
                <div class="page-header">
                    <h4>Billing Details</h4>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-bordered">
                        <tr>
                            <th>Information</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                        <?php foreach($query as $data) : ?>
                        <tr>
                            <td>Room Reserved Type : <?=$data['tipe_kamar'];?></td>
                            <td>Rp. <?=number_format($data['harga_per_mlm'], 0, ',', '.');?></td>
                            <td><?=$qty;?> Malam</td>
                            <td>Rp. <?=number_format(($data['harga_per_mlm'] * $qty), 0, ',', '.');?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php 
                        $cek = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_transaksi_kamar='$id' && status='Menunggu Pembayaran'");
                        if(mysqli_num_rows($cek) > 0) : 
                        $layanan = mysqli_query($conn, "SELECT pesanan.*, pesanan_detail.*, menu.* FROM pesanan, pesanan_detail, menu WHERE pesanan.id_transaksi_kamar='". $i['id_transaksi_kamar'] . "' && pesanan_detail.id_pesanan=pesanan.id_pesanan && menu.id_menu=pesanan_detail.id_menu && pesanan.status='Menunggu Pembayaran'");
                        foreach($layanan as $a) :
                        ?>
                        <tr>
                            <td>Service <?=$a['kategori'];?> : <?=$a['nama_menu'];?></td>
                            <td>Rp. <?=number_format($a['harga_menu'], 0, ',', '.');?></td>
                            <td><?=$a['qty'];?> Porsi</td>
                            <td>Rp. <?=number_format($a['total_harga'], 0, ',', '.');?></td>
                        </tr>
                        <?php endforeach;endif;?>

                        <?php
                        $cek = mysqli_query($conn, "SELECT * FROM laundry WHERE id_kamar='" . $i['id_kamar'] . "' && status='Menunggu Pembayaran'");
                        $id_laundry = mysqli_fetch_array($cek);
                        if(mysqli_num_rows($cek) > 0) : 
                        $layanan = mysqli_query($conn, "SELECT jenis_laundry.*, laundry_detail.*, laundry.* FROM jenis_laundry, laundry_detail, laundry WHERE laundry.id_laundry='" . $id_laundry['id_laundry'] . "' && laundry_detail.id_laundry=laundry.id_laundry && jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry");
                        foreach($layanan as $c) :
                        ?>
                        <tr>
                            <td>Laundry Type <?=$c['type'];?>( <?=$c['nama'];?> ) : <?=$c['article'];?></td>
                            <td>Rp. <?=number_format($c['harga'], 0, ',', '.');?></td>
                            <td><?=$c['qty'];?> Clothes</td>
                            <td>Rp. <?=number_format($c['harga'] * $c['qty'], 0, ',', '.');?></td>
                        </tr>
                        <?php endforeach;endif;?>

                        <?php if(empty($c['total'])){$c['total'] = '0';} $a = mysqli_query($conn, "SELECT SUM(total) as total FROM pesanan WHERE id_transaksi_kamar='" . $i['id_transaksi_kamar'] . "' && status='Menunggu Pembayaran'");$b=mysqli_fetch_array($a);$total = $b['total'] + $i['total_biaya_kamar'] + $c['total'];?>
                        <tr>
                            <?php $query = mysqli_query($conn, "SELECT * FROM fasilitas");?>
                            <th colspan="2" rowspan="10" align="left">
                                Fasilitas :
                                <?php foreach($query as $f) : ?>
                                    <div class="d-block" style="font-weight: 100"><input type="checkbox" name="fasilitas" value="<?=$f['fasilitas_name'];?>" id="<?=$f['id'];?>"> <label for="<?=$f['id'];?>"><?=$f['fasilitas_name'];?></label></div>
                                <?php endforeach;?>
                            </th>
                            <th class="text-center">Sub-Total</th>
                            <th class="text-center">Rp. <?=number_format($total, 0, ',', '.');?></th>
                            <input type="hidden" id="subtotal" value="<?=$total;?>">
                        </tr>
                        <tr align="center">
                            <th>Diskon</th>
                            <th>
                                <?php if($i['diskon'] <= 0){ ?>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <input type="number" min="0" max="100" id="diskon" class="form-control" value="0" autocomplete="off">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="number" name="diskon" min="0" id="diskonVal" class="form-control" value="0" readonly>
                                        </div>
                                    </div>
                                </div>
                                <?php } else { ?>
                                    Rp. <?=number_format($i['diskon'], 0, ',', '.');?>
                                <?php } ?>
                            </th>
                        </tr>
                        <tr align="center">
                            <th>Surcharge</th>
                            <th width="35%">
                                <?php if($i['surcharge'] == '' && $i['bayar'] == 0){ ?>
                                    <a href="#surcharge" data-toggle="modal"><span class="badge badge-primary p-2">Add Surcharge</span></a>
                                    <?php $i['surcharge'] = 0;?>
                                <?php } else { ?>
                                    Rp. <?=number_format(($i['surcharge'] == '') ? 0 : $i['surcharge'], 0, ',', '.');?>
                                <?php } ?>
                            </th>
                        </tr>
                        <tr align="center">
                            <th>21% Tax + Service</th>
                            <th id="taxService">Rp. <?=number_format($total * 0.21, 0, ',', '.');?></th>
                            <input type="hidden" value="<?=$total * 0.21;?>" id="taxServiceVal">
                        </tr>
                        <tr align="center">
                            <th>Total</th>
                            <th id="totalView">Rp. <?=number_format(($total + (($i['surcharge'] == '') ? 0 : $i['surcharge'])) + ($total + (($i['surcharge'] == '') ? 0 : $i['surcharge'])) * 0.21, 0, ',', '.');?></th>
                            <input type="hidden" value="<?=$i['surcharge'];?>" id="surchargeVal">
                        </tr>
                        <tr align="center">
                            <th>Down Payment</th>
                            <th class="text-danger">Rp. <?=number_format($i['deposit'], 0, ',', '.');?></th>
                            <input type="hidden" value="<?=$i['deposit'];?>" id="deposit">
                        </tr>
                        <tr align="center">
                            <th>Grand Total</th>
                            <th class="grandTotal <?php if(($total + (($i['surcharge'] == '') ? 0 : $i['surcharge']) + ($total * 0.21) - $i['deposit']) < 0 ){echo 'text-danger';}?>">Rp. <?=number_format(($total - $i['diskon']) + (($i['surcharge'] == '') ? 0 : $i['surcharge']) + ($total * 0.21) - $i['deposit'], 0, ',', '.');?></th>
                        </tr>
                        <tr align="center">
                            <th>Payment Metode</th>
                            <th><?=($i['bayar'] > 0) ? ucwords($i['metode_pembayaran']) : '<input type="radio" name="metode" id="cash" value="cash"> <label for="cash">Cash</label> <i class="ml-3"></i> <input type="radio" name="metode" id="tf" value="transfer"> <label for="tf">Transfer</label>'; ?></th>
                        </tr>
                        <tr align="center">
                            <th>Pay</th>
                            <input type="hidden" name="total" id="grandTotal" value="<?=$total + $i['surcharge'] + ($total * 0.21) - $i['deposit'];?>">
                            <th><?=($i['bayar'] > 0) ? 'Rp. '. $i['bayar'] : '<input type="text" name="bayar" id="pay" class="form-control" placeholder="Bayar..." required autocomplete="off">'; ?></th>
                        </tr>
                        <tr align="center">
                            <th>Refund</th>
                            <th class="text-success" id="refund">Rp. <?=($i['bayar'] > 0) ? $i['bayar'] - (($total - $i['diskon']) + (($i['surcharge'] == '') ? 0 : $i['surcharge']) + ($total * 0.21) - $i['deposit']) : 'Rp. 0'; ?></th>
                        </tr>

                    </table>
                </div>

                <div class="form-group">
                    <a href="?module=chek_in" class="btn btn-danger">Cancel</a>
                    <a href="template/cetak.php?cetak=invoice&id=<?=$id;?>" target="_blank" class="btn btn-warning"><i class="fas fa-print"></i> <?=($i['bayar'] > 0) ? 'Print Bukti Pembayaran' : 'Print Invoice'; ?></a>
                    <?=($i['bayar'] > 0) ? '<a href="?dashboard" class="btn btn-success" type="submit"><i class="fas fa-check pr-1"></i> Selesai</a>' : '<button class="btn btn-primary" type="submit"><i class="fas fa-key pr-1"></i> Chek Out</button>'; ?>
                </div>
            </form>
        </div>
    </div>

</div>

<!--Modal surcharge-->
<div class="modal fade" id="surcharge" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses/chek_out.php?act=surcharge" method="post" id="form">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus"></i> Add Surcharge</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Surcharge</label>
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="text" name="surcharge" class="form-control" placeholder="Surcharge..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Add Surcharge</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#form').submit(function(e){
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
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: data.pesan
                        }).then(function(){
                            window.location.reload();
                        });
                        setInterval(function(){window.location.reload();}, 3000);
                    }
                }
            });
        })

        $('input[name="fasilitas"').change(function(){
            var fasilitas = new Array();

            $('input:checked').each(function(){
                fasilitas.push($(this).val());
            })

            $.ajax({
                url: 'proses/fasilitas.php?session&&id=<?=$id;?>',
                method: 'post',
                data: {fasilitas: fasilitas},
                dataType: 'json',
                success: function(data){

                },
                error: function(xhr, ajaxOptions, thrownError){
                    swal({
                        title: xhr.status,
                        icon: 'error',
                        text: thrownError
                    });
                }
            })
        })

        $('#diskon').keyup(function(){
            diskon()
        })

        $('#diskon').change(function(){
            diskon()
        })

        $('#pay').keyup(function(){
            let total = $('#grandTotal').val(), pay = $(this).val();

            if(parseInt(total) - parseInt(pay) > 0){
                $('#refund').attr('class', 'text-danger');
            } else {
                $('#refund').attr('class', 'text-success');
            }

            total = parseInt(pay) - parseInt(total);

            if(pay == ''){
                $('#refund').html('Rp. 0');
            } else {
                $('#refund').html('Rp. '+ rupiah(total));
            }
        })

        $('#formChekOut').submit(function(e){
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
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: data.pesan
                        }).then(function(){
                            window.location.reload();
                        });
                    }
                    else {
                        swal({
                            title: 'Failed',
                            icon: 'error',
                            text: data.pesan
                        });
                    }
                }
            });
        });

    });

    function rupiah(angka)
    {
        var number_string = angka.toString(), sisa = number_string.length % 3, rupiah = number_string.substr(0, sisa), ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if(ribuan)
        {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah;
    }

    function diskon(){
        let total = $('#subtotal').val(), diskon = $('#diskon').val(), surcharge = $('#surchargeVal').val(), taxService = $('#taxServiceVal').val(), deposit = $('#deposit').val();

        let jumlah = (total * diskon) / 100;
        $('#diskonVal').val(jumlah);

        
        //set total
        total = parseInt(total) - parseInt(jumlah)  + parseInt(taxService);
        $('#totalView').html('Rp. '+ rupiah(total));
            
        //set grand total
        total = (parseInt(total) + parseInt(surcharge)) - parseInt(deposit);
        $('.grandTotal').html('Rp. '+ rupiah(total));
        $('#grandTotal').val(total);
    }
</script>