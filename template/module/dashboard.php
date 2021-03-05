<?php
$per_hal = 5;
$jumlah = mysqli_query($conn, "SELECT * FROM transaksi_kamar");
$jumlah = mysqli_num_rows($jumlah);
$halaman = ceil($jumlah / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
$chekout = $tgl->format('y-m-d');
$jumlah2 = mysqli_query($conn, "SELECT * FROM transaksi_kamar WHERE tgl_checkout='$chekout'");
$jumlah2 = mysqli_num_rows($jumlah2);
$halaman2 = ceil($jumlah2 / $per_hal);
$page2 = (isset($_GET['page2'])) ? (int)$_GET['page2'] : 1;
$start2 = ($page2 - 1) * $per_hal;
?>
<div class="container-fluid">

        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <!--Icon Card-->
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-bed"></i>
                  </div>
                    <div class="mr-5"><h2><?=$tersedia;?></h2> Room Available</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="?module=chek_in">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-4">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-bed"></i>
                  </div>
                  <div class="mr-5"><h2><?=$terpakai;?></h2> Room Used</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="?module=chek_out">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-4">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-bed"></i>
                  </div>
                  <div class="mr-5"><h2><?=$kotor;?></h2>Dirty Room</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
              </div>
            </div>
        </div>

        <!--tamu-->
        <div class="row">

            <div class="col-sm-6 mb-4">
            <div class="card bg-white border-top-2-primary">
              <div class="card-header"><h4>Guest staying overnight</h4></div>
              <div class="card-body">
                    <?php $query = mysqli_query($conn, "SELECT transaksi_kamar.*, tamu.*, kamar.*  FROM transaksi_kamar, tamu, kamar WHERE transaksi_kamar.status='Check In' && tamu.id_tamu=transaksi_kamar.id_tamu && kamar.id_kamar=transaksi_kamar.id_kamar ORDER BY tgl_checkin DESC LIMIT $start, $per_hal");
                  if(mysqli_num_rows($query)<=0){ ?>
                    <div class="alert alert-success">
                      Sorry, for the moment there are no guest staying.
                    </div>
                    <?php }else{ ?>
                    <div class="table-responsive">
                    <table class="table bordered table-hovered">
                    <tr>
                      <th width='40%'>Name</th>
                      <th>#Room</th>
                      <th>Date / Time Check In</th>
                    </tr>
                    <?php
                    while($i=mysqli_fetch_array($query)) : 
                    ?>
                    <tr>
                      <td><?=$i['nama_depan'].' '.$i['nama_belakang'];?></td>
                      <td><?=$i['no_kamar'];?></td>
                        <td><?=$i['tgl_checkin'].' / '.$i['waktu_checkin'];?>
                    </tr>
                    <?php endwhile;?>
                  </table>
                  </div>
                  <?php } ?>
                  <ul class="pagination">
                      <?php for($i=1;$i<=$halaman;$i++) : ?>
                      <li><a class="page-link" href="?page=<?=$i;?>"><?=$i?></a></li>
                      <?php endfor;?>
                  </ul>
              </div>
              <div class="card-footer text-mutted small">Last update today at <?=$tgl->format('H:i');?></div>
            </div>
          </div>
          <div class="col-sm-6 mb-4">
            <div class="card bg-white border-top-2-primary">
              <div class="card-header"><h4>Guests who will checkout today</h4></div>
              <div class="card-body">
                <div class="table-responsive">
                <table class="table bordered table-hovered">
                  <tr>
                   <th width='40%'>Name</th>
                   <th>#Room</th>
                   <th>Date / Time Check Out</th>
                  </tr>
                <?php
                $query = mysqli_query($conn, "SELECT transaksi_kamar.*, tamu.*, kamar.*  FROM transaksi_kamar, tamu, kamar WHERE transaksi_kamar.tgl_checkout='".$tgl->format('Y-m-d')."' && tamu.id_tamu=transaksi_kamar.id_tamu && kamar.id_kamar=transaksi_kamar.id_kamar LIMIT $start2, $per_hal");
                while($i=mysqli_fetch_array($query)) :
                ?>
                  <tr>
                    <td><?=$i['nama_depan'].' '.$i['nama_belakang'];?></td>
                    <td><?=$i['no_kamar'];?></td>
                    <td><?=$i['tgl_checkout'].' / '.$i['waktu_checkout'];?></td>
                  </tr>
                  <?php endwhile;?>
                </table>
                </div>
                <ul class="pagination">
                      <?php for($i=1;$i<=$halaman2;$i++) : ?>
                      <li><a class="page-link" href="?page2=<?=$i;?>"><?=$i?></a></li>
                      <?php endfor;?>
                  </ul>
                </div>
              <div class="card-footer text-mutted small">Last update today at <?=$tgl->format('H:i');?></div>
            </div>
          </div>

        </div>

    </div>