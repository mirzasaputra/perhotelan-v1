<?php
session_start();
include "../config/database.php";
include "../assets/pdf/fpdf.php";

$perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan");
$perusahaan = mysqli_fetch_array($perusahaan);

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

$pdf = new FPDF("P", "cm", "A4");

$pdf->setMargins(1, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setFont('times', 'B', 18);
$pdf->Image('../assets/img/'. $perusahaan['logo'], 1, 1, 2);
$pdf->multiCell(19, 0.5, $perusahaan['nama_hotel'], 0, 'C');
$pdf->setFont('times', '', 13);
$pdf->multiCell(19, 0.8, $perusahaan['nama_perusahaan'], 0, 'C');
$pdf->setFont('times', '', 11);
$pdf->multiCell(19, 0.4, 'Alamat : Jl. ' . $perusahaan['jalan'] . ' No. ' . $perusahaan['no_jalan'] . ' ' . $perusahaan['kecamatan']. ', ' . $perusahaan['kabupaten'] . ', ' . $perusahaan['provinsi'], 0, 'C');
$pdf->multiCell(19, 0.4, 'No. Telp : ' . $perusahaan['no_telp'] . '     No. Fax : ' . $perusahaan['no_fax'], 0, 'C');
$pdf->multiCell(19, 0.4,  'Website : ' . $perusahaan['website'] . '    Email : ' . $perusahaan['email'], 0, 'C');
$pdf->line(1, 4, 20, 4);
$pdf->setLineWidth(0.1);
$pdf->line(1, 4.1, 20, 4.1);
$pdf->setLineWidth(0);
$pdf->ln(1);
if($_GET['cetak'] == 'pesanan') : 

    $query = mysqli_query($conn, "SELECT * FROM transaksi_resto");

    $pdf->setFont('times', 'B', 14);
    $pdf->cell(19, 0.3, 'Order Report', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(10, 0.7, 'Printed on : ' . date('D, d M y') . ',', 0, 0, 'L');
    $pdf->ln(1);
    $pdf->setFont('arial', 'B', 10);
    $pdf->setX(2);
    $pdf->cell(5, 1, 'ID Pesanan', 1, 0, 'C');
    $pdf->cell(6, 1, 'Date / Time', 1, 0, 'C');
    $pdf->cell(6, 1, 'Total', 1, 1, 'C');

    foreach($query as $i) : 

        $pdf->setFont('times', '', 10);
        $pdf->setX(2);
        $pdf->cell(5, 1, $i['id_pesanan'], 1, 0, 'C');
        $pdf->cell(6, 1, $i['waktu'] . ' | ' . $i['tgl'], 1, 0, 'C');
        $pdf->cell(6, 1, 'Rp. ' . number_format($i['total'], 0, ',', '.'), 1, 1, 'C');

    endforeach;

    $query = mysqli_query($conn, "SELECT SUM(total) as total FROM transaksi_resto");
    $a = mysqli_fetch_array($query);

    $pdf->setFont('times', 'B', 10);
    $pdf->setX(2);
    $pdf->cell(5, 1, '', 0, 0, '');
    $pdf->cell(6, 1, 'Total Income', 1, 0, 'C');
    $pdf->cell(6, 1, 'Rp. ' . number_format($a['total'], 0, ',', '.'), 1,1, 'C');

endif;

//bukti pembayaran
if($_GET['cetak'] == 'bukti_pembayaran') :
    
    $pdf->setFont('times', 'B', 14);
    $pdf->cell(19, 0.3, 'Proof of payment', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(10, 0.7, 'Printed on : ' . date('D, d M Y'), 0, 0, 'L');
    $pdf->ln(1);
    $pdf->setFont('times', '', 10);
    
    $id_pesanan = $_GET['id_pesanan'];
    $query = mysqli_query($conn, "SELECT pesanan.*, tamu.*, transaksi_kamar.* FROM pesanan, tamu, transaksi_kamar WHERE pesanan.id_pesanan='$id_pesanan' && transaksi_kamar.id_transaksi_kamar=pesanan.id_transaksi_kamar && tamu.id_tamu=transaksi_kamar.id_tamu");
    $i = mysqli_fetch_array($query);

    $pdf->cell(10, 0.5, 'Name : ' . $i['prefix'] . '. ' . $i['nama_depan'] . ' ' . $i['nama_belakang'], 0, 1, 'L');
    $pdf->cell(10, 0.5, 'Date/Time : ' . $i['waktu'] . ' / ' . $i['tanggal'], 0, 1, 'L');
    $pdf->ln(.8);
    $pdf->setFont('times', 'B', 13);
    $pdf->cell(10, 0.7, 'Order detail : ', 0, 1, 'L');
    $pdf->setFont('times', 'B', 11);
    $pdf->ln(.3);
    $pdf->setX(1.6);
    $pdf->cell(1, 0.8, 'No.', 1, 0, 'C');
    $pdf->cell(5, 0.8, 'Name Menu', 1, 0, 'C');
    $pdf->cell(5, 0.8, 'Price', 1, 0, 'C');
    $pdf->cell(1.5, 0.8, 'Qty', 1, 0, 'C');
    $pdf->cell(5, 0.8, 'Total', 1, 1, 'C');
    
    $no = 1;
    $query = mysqli_query($conn, "SELECT pesanan_detail.*, menu.* FROM pesanan_detail, menu WHERE pesanan_detail.id_pesanan='$id_pesanan' && menu.id_menu=pesanan_detail.id_menu");
    foreach($query as $i) : 
        
        $pdf->setFont('times', '', 10);
        $pdf->setX(1.6);
        $pdf->cell(1, 0.7, $no++, 1, 0, 'C');
        $pdf->cell(5, 0.7, '  ' . $i['nama_menu'], 1, 0, 'L');
        $pdf->cell(5, 0.7, '  Rp. ' . number_format($i['harga_menu'], 0, ',', '.'), 1, 0, 'L');
        $pdf->cell(1.5, 0.7, '  ' . $i['qty'], 1, 0, 'C');
        $pdf->cell(5, 0.7, '  Rp. ' . number_format($i['total_harga'], 0, ',', '.'), 1, 1, 'L');

    endforeach;

    $query = mysqli_query($conn, "SELECT * FROM transaksi_resto WHERE id_pesanan='$id_pesanan'");
    $total = mysqli_fetch_array($query);

    $pdf->setFont('times', 'B', 11);
    $pdf->setX(1.6);
    $pdf->cell(6, 0.8, '', 0, 0, 'L');
    $pdf->cell(6.5, 0.8, '  Total', 1, 0, 'L');
    $pdf->cell(5, 0.8, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 1, 'L');
    $pdf->setX(1.6);
    $pdf->cell(6, 0.8, '', 0, 0, 'L');
    $pdf->cell(6.5, 0.8, '  Pay', 1, 0, 'L');
    $pdf->cell(5, 0.8, '  Rp. ' . number_format($total['bayar'], 0, ',', '.'), 1, 1, 'L');
    $pdf->setX(1.6);
    $pdf->cell(6, 0.8, '', 0, 0, 'L');
    $pdf->cell(6.5, 0.8, '  Refund', 1, 0, 'L');
    $pdf->cell(5, 0.8, '  Rp. ' . number_format($total['bayar'] - $total['total'], 0, ',', '.'), 1, 1, 'L');

endif;

//transaksi kamar
if($_GET['cetak'] == 'transaksi_kamar') : 

    $month = $_GET['month'];
    $years = $_GET['years'];

    $pdf->setFont('times', 'B', 14);
    $pdf->cell(19, 0.3, 'Room Transaction Report', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(10, 0.7, 'Printed on : ' . date('D, d M Y'), 0, 1, 'L');
    $pdf->ln(.2);
    $pdf->cell(19, 0.7, 'Room transaction report for the month ' . $monthList[$month] . ' ' . $years, 0, 1, 'L');
    $pdf->setX(1);
    $pdf->setFont('arial', 'B', 8);
    $pdf->cell(.8, 1, 'No.', 1, 0, 'C');
    $pdf->cell(2.7, 1, 'Date Transaction', 1, 0, 'C');
    $pdf->cell(3, 1, 'No. Invoice', 1, 0, 'C');
    $pdf->cell(2.5, 1, 'Total cost', 1, 0, 'C');
    $pdf->cell(2.5, 1, 'Dp Cash', 1, 0, 'C');
    $pdf->cell(2.5, 1, 'Dp Transfer', 1, 0, 'C');
    $pdf->cell(2.5, 1, 'Paid Cash', 1, 0, 'C');
    $pdf->cell(2.5, 1, 'Paid Transfer', 1, 1, 'C');

    $query = mysqli_query($conn, "SELECT * FROM transaksi_kamar WHERE month(tanggal) = '$month' && year(tanggal) = '$years' && status='check out'");
    $no = 1;

    foreach($query as $i) :

        $pdf->setX(1);
        $pdf->setFont('arial', '', 7);
        $pdf->cell(.8, 0.85, '  ' . $no++ . '.', 1, 0, 'L');
        $pdf->cell(2.7, 0.85, '  ' . $i['tanggal'], 1, 0, 'L');
        $pdf->cell(3, 0.85, '  ' . $i['no_invoice'], 1, 0, 'L');
        $pdf->cell(2.5, 0.85, ' Rp.' . number_format($i['total'], 0, ',', '.'), 1, 0, 'L');
        $pdf->cell(2.5, 0.85, ($i['metode_deposit'] == 'cash') ? ' Rp.' . number_format($i['deposit'], 0, ',', '.') : '', 1, 0, 'L');
        $pdf->cell(2.5, 0.85, ($i['metode_deposit'] == 'transfer') ? ' Rp.' . number_format($i['deposit'], 0, ',', '.') : '', 1, 0, 'L');
        $pdf->cell(2.5, 0.85, ($i['metode_pembayaran'] == 'cash') ? ' Rp.' . number_format($i['bayar'], 0, ',', '.') : '', 1, 0, 'L');
        $pdf->cell(2.5, 0.85, ($i['metode_pembayaran'] == 'transfer') ? ' Rp.' . number_format($i['bayar'], 0, ',', '.') : '', 1, 1, 'L');

    endforeach;

    
    $pdf->setX(1);
    $pdf->setFont('arial', 'B', 8);
    $pdf->cell(3.5, 1, '', 0, 0, 'L');
    $pdf->cell(3, 1, '  Total Income', 1, 0, 'L');
    $query = mysqli_query($conn, "SELECT SUM(total_biaya_kamar) as total FROM transaksi_kamar");$total = mysqli_fetch_array($query);
    $pdf->cell(2.5, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 0, 'L');
    $query = mysqli_query($conn, "SELECT SUM(deposit) as total FROM transaksi_kamar WHERE metode_deposit='cash'");$total = mysqli_fetch_array($query);
    $pdf->cell(2.5, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 0, 'L');
    $query = mysqli_query($conn, "SELECT SUM(deposit) as total FROM transaksi_kamar WHERE metode_deposit='transfer'");$total = mysqli_fetch_array($query);
    $pdf->cell(2.5, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 0, 'L');
    $query = mysqli_query($conn, "SELECT SUM(bayar) as total FROM transaksi_kamar WHERE metode_pembayaran='cash'");$total = mysqli_fetch_array($query);
    $pdf->cell(2.5, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 0, 'L');
    $query = mysqli_query($conn, "SELECT SUM(bayar) as total FROM transaksi_kamar WHERE metode_pembayaran='transfer'");$total = mysqli_fetch_array($query);
    $pdf->cell(2.5, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 1, 'L');

endif;

//transaksi restaurant
if($_GET['cetak'] == 'transaksi_resto') : 

    $month = $_GET['month'];
    $years = $_GET['years'];

    $pdf->setFont('times', 'B', 14);
    $pdf->cell(19, 0.3, 'Restaurant Transaction Report', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(10, 0.7, 'Printed on : ' . date('D, d M Y'), 0, 1, 'L');
    $pdf->ln(.2);
    $pdf->cell(19, 0.7, 'Restaurant transaction report for the month ' . $monthList[$month] . ' ' . $years, 0, 1, 'L');
    $pdf->setFont('arial', 'B', 11);
    $pdf->cell(4, 1, 'Date Transaction', 1, 0, 'C');
    $pdf->cell(5, 1, 'Produk / Service', 1, 0, 'C');
    $pdf->cell(4, 1, 'Price', 1, 0, 'C');
    $pdf->cell(2, 1, 'Qty', 1, 0, 'C');
    $pdf->cell(4, 1, 'Total', 1, 1, 'C');

    $query = mysqli_query($conn, "SELECT pesanan.*, pesanan_detail.*, menu.* FROM pesanan, pesanan_detail, menu WHERE month(tanggal) = '$month' && year(tanggal) = '$years' && pesanan_detail.id_pesanan=pesanan.id_pesanan && menu.id_menu=pesanan_detail.id_menu");

    foreach($query as $i) :

        $pdf->setFont('arial', '', 10);
        $pdf->cell(4, .85, '  ' . $i['tanggal'], 1, 0, 'L');
        $pdf->cell(5, .85, '  ' . $i['nama_menu'], 1, 0, 'L');
        $pdf->cell(4, .85, '  Rp. ' . number_format($i['harga_menu'], 0, ',', '.'), 1, 0, 'L');
        $pdf->cell(2, .85, $i['qty'], 1, 0, 'C');
        $pdf->cell(4, .85, '  Rp. ' . number_format($i['total_harga'], 0, ',', '.'), 1, 1, 'L');

    endforeach;

    $query = mysqli_query($conn, "SELECT SUM(total) as total FROM transaksi_resto");$total = mysqli_fetch_array($query);

    $pdf->setFont('arial', 'B', 11);
    $pdf->cell(9, 1, '', 0, 0, 'L');
    $pdf->cell(6, 1, '  Total Income', 1, 0, 'L');
    $pdf->cell(4, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 1, 'L');

endif;

//bukti laundry
if($_GET['cetak'] == 'bukti_laundry') :

    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM kamar, laundry WHERE laundry.id_laundry='$id' && kamar.id_kamar=laundry.id_kamar");
    $data = mysqli_fetch_array($query);

    $pdf->setFont('times', 'B', '14');
    $pdf->cell(19, 0.3, 'Proof Of Laundry Payment', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(19, 0.7, 'Printed on : ' . date('D, d M Y'), 0, 1, 'L');
    $pdf->ln(.2);
    $pdf->cell(19, 0.5, 'Room : ' . $data['no_kamar'], 0, 1, 'L');
    $pdf->cell(19, 0.5, 'Date / Time : ' . $data['waktu'] . ' / ' . $data['tanggal'], 0, 1, 'L');
    $pdf->ln(.5);
    $pdf->setFont('times', 'B', '13');
    $pdf->cell(19, 0.7, 'Laundry detail : ', 0, 1, 'L');
    $pdf->line(1, 9, 20, 9);
    $pdf->ln(.5);
    $pdf->setFont('arial', 'B', 10);
    $pdf->cell(1, 0.8, 'No.', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Type.', 1, 0, 'C');
    $pdf->cell(4, 0.8, 'Type Clothes', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Article', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Price', 1, 0, 'C');
    $pdf->cell(2, 0.8, 'Qty', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Total', 1, 1, 'C');

    $no = 1;
    $query = mysqli_query($conn, "SELECT laundry_detail.*, jenis_laundry.*, laundry.* FROM laundry_detail, jenis_laundry, laundry WHERE laundry.id_laundry='$id' && laundry_detail.id_laundry='$id' && jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry");
    foreach($query as $i) : 

        $pdf->setFont('arial', '', 9);
        $pdf->cell(1, 0.7, '  ' . $no++ . '.', 1, 0, 'L');
        $pdf->cell(3, 0.7, '  ' . $i['type'], 1, 0, 'L');
        $pdf->cell(4, 0.7, '  ' . $i['nama'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  ' . $i['article'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  Rp. ' . number_format($i['harga'], 0, ',', '.') . ',-', 1, 0, 'L');
        $pdf->cell(2, 0.7, '  ' . $i['qty'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  Rp. ' . number_format($i['harga'] * $i['qty'], 0, ',', '.') . ',-', 1, 1, 'L');
        
    endforeach;

    $pdf->setFont('arial', 'B', 10);
    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  Sub Total', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['total'], 0, ',', '.'), 1, 1, 'C');

    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  PPn 21%', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['total'] * 0.21, 0, ',', '.'), 1, 1, 'C');

    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  Grand Total', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['total'] + ($i['total'] * 0.21), 0, ',', '.'), 1, 1, 'C');
    
    $query = mysqli_query($conn, "SELECT * FROM transaksi_laundry WHERE id_laundry='$id'");
    $a = mysqli_fetch_array($query);
    
    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  Pay', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($a['bayar'], 0, ',', '.'), 1, 1, 'C');

    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  Refund', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($a['bayar'] - $i['total'], 0, ',', '.'), 1, 1, 'C');
    
endif;

//Bill laundry
if($_GET['cetak'] == 'bill_laundry') :

    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT kamar.*, laundry.* FROM kamar, laundry WHERE laundry.id_laundry='$id' && kamar.id_kamar=laundry.id_kamar");
    $data = mysqli_fetch_array($query);

    $pdf->setFont('times', 'B', '14');
    $pdf->cell(19, 0.3, 'Bill Laundry', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(19, 0.7, 'Printed on : ' . date('D, d M Y'), 0, 1, 'L');
    $pdf->ln(.2);
    $pdf->cell(19, 0.5, 'Room : ' . $data['no_kamar'], 0, 1, 'L');
    $pdf->cell(19, 0.5, 'Date/Time : ' . $data['waktu'] . ' / ' . $data['tanggal'], 0, 1, 'L');
    $pdf->ln(.5);
    $pdf->setFont('times', 'B', '13');
    $pdf->cell(19, 0.7, 'Laundry detail : ', 0, 1, 'L');
    $pdf->line(1, 9, 20, 9);
    $pdf->ln(.5);
    $pdf->setFont('arial', 'B', 10);
    $pdf->cell(1, 0.8, 'No.', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Type.', 1, 0, 'C');
    $pdf->cell(4, 0.8, 'Type Clothes', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Article', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Price', 1, 0, 'C');
    $pdf->cell(2, 0.8, 'Qty', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Total', 1, 1, 'C');

    $no = 1;
    $query = mysqli_query($conn, "SELECT laundry_detail.*, jenis_laundry.*, laundry.* FROM laundry_detail, jenis_laundry, laundry WHERE laundry.id_laundry='$id' && laundry_detail.id_laundry='$id' && jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry");
    foreach($query as $i) : 

        $pdf->setFont('arial', '', 9);
        $pdf->cell(1, 0.7, '  ' . $no++ . '.', 1, 0, 'L');
        $pdf->cell(3, 0.7, '  ' . $i['type'], 1, 0, 'L');
        $pdf->cell(4, 0.7, '  ' . $i['nama'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  ' . $i['article'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  Rp. ' . number_format($i['harga'], 0, ',', '.') . ',-', 1, 0, 'L');
        $pdf->cell(2, 0.7, '  ' . $i['qty'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  Rp. ' . number_format($i['harga'] * $i['qty'], 0, ',', '.') . ',-', 1, 1, 'L');
        
    endforeach;

    $pdf->setFont('arial', 'B', 10);
    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  Sub Total', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['total'], 0, ',', '.'), 1, 1, 'C');

    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  PPn 21%', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['total'] * 0.21, 0, ',', '.'), 1, 1, 'C');

    $pdf->cell(11, 0.8, '', 0, 0, 'C');
    $pdf->cell(5, 0.8, '  Grand Total', 1, 0, 'C');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['total'] + ($i['total'] * 0.21), 0, ',', '.'), 1, 1, 'C');
    
endif;

//transaksi laundry
if($_GET['cetak'] == 'transaksi_laundry') : 

    $month = $_GET['month'];
    $years = $_GET['years'];

    $pdf->setFont('times', 'B', 14);
    $pdf->cell(19, 0.3, 'Laundry Transaction Report', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    $pdf->cell(10, 0.7, 'Di cetak pada : ' . date('D, d M Y'), 0, 1, 'L');
    $pdf->ln(.2);
    $pdf->cell(19, 0.7, 'Laundry Transaction Report for the Month ' . $monthList[$month] . ' ' . $years, 0, 1, 'L');
    $pdf->setX(2);
    $pdf->setFont('arial', 'B', 11);
    $pdf->cell(1, 1, 'No.', 1, 0, 'C');
    $pdf->cell(4, 1, 'Room', 1, 0, 'C');
    $pdf->cell(6, 1, 'Date Transaction', 1, 0, 'C');
    $pdf->cell(6, 1, 'Total', 1, 1, 'C');

    $query = mysqli_query($conn, "SELECT laundry.*, transaksi_laundry.*, kamar.* FROM transaksi_laundry, kamar, laundry WHERE month(transaksi_laundry.tanggal) = '$month' && year(transaksi_laundry.tanggal) = '$years' && laundry.id_laundry=transaksi_laundry.id_laundry && kamar.id_kamar=laundry.id_kamar");
    $no = 1;

    foreach($query as $i) :

        $pdf->setX(2);
        $pdf->setFont('arial', '', 10);
        $pdf->cell(1, 0.85, '  ' . $no++ . '.', 1, 0, 'L');
        $pdf->cell(4, 0.85, '  ' . $i['no_kamar'], 1, 0, 'L');
        $pdf->cell(6, 0.85, '  ' . $i['tanggal'], 1, 0, 'L');
        $pdf->cell(6, 0.85, '  Rp. ' . number_format($i['total'], 0, ',', '.'), 1, 1, 'L');

    endforeach;

    $query = mysqli_query($conn, "SELECT SUM(total) as total FROM transaksi_laundry");$total = mysqli_fetch_array($query);

    $pdf->setX(2);
    $pdf->setFont('arial', 'B', 11);
    $pdf->cell(5, 1, '', 0, 0, 'L');
    $pdf->cell(6, 1, '  Total Income', 1, 0, 'L');
    $pdf->cell(6, 1, '  Rp. ' . number_format($total['total'], 0, ',', '.'), 1, 1, 'L');

endif;

if($_GET['cetak'] == 'invoice') : 

    $pdf->setFont('times', 'B', 14);
    $pdf->cell(19, 0.3, 'Invoice', 0, 0, 'C');
    $pdf->ln(1.5);
    $pdf->setFont('times', 'B', 10);
    
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT transaksi_kamar.*, tamu.* FROM tamu, transaksi_kamar WHERE transaksi_kamar.id_transaksi_kamar='$id' && tamu.id_tamu=transaksi_kamar.id_tamu");
    $i = mysqli_fetch_array($query);
    
    $pdf->cell(10, 0.5, 'Addressed to : ', 0, 1, 'L');
    $pdf->cell(10, 0.5, $i['prefix'] . '. ' . $i['nama_depan'] . ' ' . $i['nama_belakang'], 0, 1, 'L');
    $pdf->cell(10, 0.5, 'Jln. ' . $i['jalan'] . ' No. ' . $i['no_jalan'] . ', ' . $i['kabupaten'] . ' - ' . $i['provinsi'] . ' - ' . $i['warga_negara'], 0, 1, 'L');
    $pdf->ln(.3);

    $pdf->cell(10, 0.5, 'No. Invoice : ' . $i['no_invoice'], 0, 1, 'L');
    $pdf->cell(10, 0.5, 'Date of issue : ' . date('D, d M Y'), 0, 1, 'L');
    $pdf->ln(.7);

    $pdf->setFont('arial', 'B', '12');
    $pdf->setX(1.5);
    $pdf->cell(10, 0.5, 'Billings details', 0, 1, 'L');
    $pdf->line(1, 10, 20, 10);
    $pdf->ln(.8);

    $pdf->setFont('arial', 'B', 10);
    $pdf->cell(11, 0.8, 'Information', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Price', 1, 0, 'C');
    $pdf->cell(2, 0.8, 'Qty', 1, 0, 'C');
    $pdf->cell(3, 0.8, 'Total', 1, 1, 'C');

    $query = mysqli_query($conn, "SELECT transaksi_kamar.*, transaksi_kamar_detail.*, tamu.*, kamar.*, tipe_kamar.* FROM transaksi_kamar, transaksi_kamar_detail, tamu, kamar, tipe_kamar WHERE transaksi_kamar.id_transaksi_kamar='$id' && tamu.id_tamu=transaksi_kamar.id_tamu && transaksi_kamar_detail.id_transaksi_kamar=transaksi_kamar.id_transaksi_kamar && kamar.id_kamar=transaksi_kamar_detail.id_kamar && tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar");
    $i = mysqli_fetch_array($query);

    //meghitung qty
    $in = date_create($i['tgl_checkin']);
    $out = date_create($i['tgl_checkout']);
    $qty = date_diff($in, $out)->format('%a');
    if($qty == 0){
        $qty = 1;
    }

    $pdf->setFont('arial', '', 8);
    foreach($query as $a){
        $pdf->cell(11, 0.7, '  Room Reserved Type : ' . $a['tipe_kamar'], 1, 0, 'L');
        $pdf->cell(3, 0.7, '  Rp. ' . number_format($a['harga_per_mlm'], 0, ',', '.') . ',-', 1, 0, 'L');
        $pdf->cell(2, 0.7, '  ' . $qty . ' Malam', 1, 0, 'L');
        $pdf->cell(3, 0.7, '  Rp. ' . number_format($a['harga_per_mlm'] * $qty, 0, ',', '.') . ',-', 1, 1, 'L');
    }

    $cek = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_transaksi_kamar='$id' && status='Menunggu Pembayaran'");
    if(mysqli_num_rows($cek) > 0) : 
        $layanan = mysqli_query($conn, "SELECT pesanan.*, pesanan_detail.*, menu.* FROM pesanan, pesanan_detail, menu WHERE pesanan.id_transaksi_kamar='". $i['id_transaksi_kamar'] . "' && pesanan_detail.id_pesanan=pesanan.id_pesanan && menu.id_menu=pesanan_detail.id_menu && pesanan.status='Menunggu Pembayaran'");
        foreach($layanan as $a) :
            $pdf->cell(11, 0.7, '  Layanan ' . $a['kategori'] . ' : ' . $a['nama_menu'], 1, 0, 'L');
            $pdf->cell(3, 0.7, '  Rp. ' . number_format($a['harga_menu'], 0, ',', '.') . ',-', 1, 0, 'L');
            $pdf->cell(2, 0.7, '  ' . $a['qty'] . ' Porsi', 1, 0, 'L');
            $pdf->cell(3, 0.7, '  Rp. ' . number_format($a['total_harga'], 0, ',', '.') . ',-', 1, 1, 'L');
        endforeach;
    endif;
    
    $cek = mysqli_query($conn, "SELECT * FROM laundry WHERE id_kamar='" . $i['id_kamar'] . "' && status='Menunggu Pembayaran'");
    $id_laundry = mysqli_fetch_array($cek);
    if(mysqli_num_rows($cek) > 0) : 
        $layanan = mysqli_query($conn, "SELECT jenis_laundry.*, laundry_detail.*, laundry.* FROM jenis_laundry, laundry_detail, laundry WHERE laundry.id_laundry='" . $id_laundry['id_laundry'] . "' && laundry_detail.id_laundry=laundry.id_laundry && jenis_laundry.id_jenis_laundry=laundry_detail.id_jenis_laundry");
        foreach($layanan as $c) :
            $pdf->cell(11, 0.7, '  Laundry Type ' . $c['type'] . ' ( ' . $c['nama'] . ' ) : ' . $c['article'], 1, 0, 'L');
            $pdf->cell(3, 0.7, '  Rp. ' . number_format($c['harga'], 0, ',', '.') . ',-', 1, 0, 'L');
            $pdf->cell(2, 0.7, '  ' . $c['qty'] . ' Clothes', 1, 0, 'L');
            $pdf->cell(3, 0.7, '  Rp. ' . number_format($c['harga'] * $c['qty'], 0, ',', '.') . ',-', 1, 1, 'L');
        endforeach;
    endif;
    
    if(empty($c['total'])){$c['total'] = '0';} $a = mysqli_query($conn, "SELECT SUM(total) as total FROM pesanan WHERE id_transaksi_kamar='" . $i['id_transaksi_kamar'] . "' && status='Menunggu Pembayaran'");$b=mysqli_fetch_array($a);$total = $b['total'] + $i['total_biaya_kamar'] + $c['total'];
    $pdf->setFont('arial', 'B', 8);
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(5, 0.8, '  Sub Total', 1, 0, 'L');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($total, 0, ',', '.') . ',-', 1, 1, 'L');

    
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(5, 0.8, '  Discount', 1, 0, 'L');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['diskon'], 0, ',', '.') . ',-', 1, 1, 'L');
    
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(5, 0.8, '  Surcharge', 1, 0, 'L');
    if($i['surcharge'] == ''){$i['surcharge'] = '0';}
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['surcharge'], 0, ',', '.') . ',-', 1, 1, 'L');
    
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(5, 0.8, '  21% Tax + Service', 1, 0, 'L');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($total * 0.21, 0, ',', '.') . ',-', 1, 1, 'L');
    
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(5, 0.8, '  Total', 1, 0, 'L');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format(($total + $i['surcharge']) + ($total + $i['surcharge']) * 0.21, 0, ',', '.') . ',-', 1, 1, 'L');
    
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(3, 0.8, '', 0, 0, 'L');
    $pdf->cell(2, 0.8, '  Dp', 1, 0, 'L');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['deposit'], 0, ',', '.') . ',-', 1, 1, 'L');
    
    $pdf->cell(11, 0.8, '', 0, 0, 'L');
    $pdf->cell(3, 0.8, '', 0, 0, 'L');
    $pdf->cell(2, 0.8, '  Grand Total', 1, 0, 'L');
    $pdf->cell(3, 0.8, '  Rp. ' . number_format(($total - $i['diskon']) + $i['surcharge'] + ($total * 0.21) - $i['deposit'], 0, ',', '.') . ',-', 1, 1, 'L');
    
    if($i['bayar']){
        $pdf->cell(11, 0.8, '', 0, 0, 'L');
        $pdf->cell(3, 0.8, '', 0, 0, 'L');
        $pdf->cell(2, 0.8, '  Via', 1, 0, 'L');
        $pdf->cell(3, 0.8,  ' '. ucwords($i['metode_pembayaran']), 1, 1, 'L');
        
        $pdf->cell(11, 0.8, '', 0, 0, 'L');
        $pdf->cell(3, 0.8, '', 0, 0, 'L');
        $pdf->cell(2, 0.8, '  Pay', 1, 0, 'L');
        $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['bayar'], 0, ',', '.') . ',-', 1, 1, 'L');
        
        $pdf->cell(11, 0.8, '', 0, 0, 'L');
        $pdf->cell(3, 0.8, '', 0, 0, 'L');
        $pdf->cell(2, 0.8, '  Refund', 1, 0, 'L');
        $pdf->cell(3, 0.8, '  Rp. ' . number_format($i['bayar'] - (($total - $i['diskon']) + $i['surcharge'] + ($total * 0.21) - $i['deposit']), 0, ',', '.') . ',-', 1, 1, 'L');
    }
    
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $dataUser = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' && password='$pass'");
    $dataUser = mysqli_fetch_array($dataUser);

    $pdf->cell(5, 2, '', 0, 1, 'C');
    $pdf->cell(5, 2, 'Prepared By', 0, 1, 'C');
    $pdf->cell(5, 2, '('. $dataUser['nama_user'] .')', 0, 1, 'C');
    
    $pdf->setXY(1, 14);
    $pdf->cell(11, 0.6, 'Fasilitas : ', 0, 1);

    if(isset($_SESSION['fasilitas_'. $id])){
        foreach($_SESSION['fasilitas_'. $id] as $f) {
            $pdf->cell(11, 0.3, '*'. $f, 0, 1);
        }
    }

endif;

if($_GET['cetak'] !== 'invoice'){
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $dataUser = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' && password='$pass'");
    $dataUser = mysqli_fetch_array($dataUser);
    
    $pdf->cell(5, 2, '', 0, 1, 'C');
    $pdf->cell(5, 2, 'Prepared By', 0, 1, 'C');
    $pdf->cell(5, 2, '('. $dataUser['nama_user'] .')', 0, 1, 'C');
}

$pdf->Output("Laporan.pdf", "I");