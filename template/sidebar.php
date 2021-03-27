<div id="sidebar">

  <div class="sidebar-menu">
    <div class="sidebar-header">
      <img src="assets/img/<?=$data_user['image'];?>" alt="" class="img-circle img-user">
      <marquee><span class="nama-user"><?=$data_user["nama_user"];?></span></marquee>
      <span class="tgl"><?=$date;?></span>
    </div>
    <ul class="sidebar navbar-nav">

      <!--Sidebar ADmin-->
      <?php if($data_user['level'] == "Super Admin") :?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=dashboard" class="nav-link i">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#chek-in-out" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-key"></i>
          <span>Check In / Out</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="chek-in-out">
          <ul>
            <li><a href="?module=chek_in" class="nav-livk">Check In</a></li>
            <li><a href="?module=booking" class="nav-livk">Booking</a></li>
            <li><a href="?module=chek_out" class="nav-livk">Check Out</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#resto" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-utensils"></i>
          <span>Restaurant</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="resto">
          <ul>
            <li><a href="?module=restaurant/menu" class="nav-livk">Menu</a></li>
            <li><a href="?module=restaurant/meja" class="nav-livk">Table</a></li>
            <li><a href="?module=restaurant/petugas" class="nav-livk">Officer</a></li>
            <li><a href="?module=restaurant/pesanan" class="nav-livk">Order</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#room-service" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-book"></i>
          <span>Room Service</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="room-service">
          <ul>
            <li><a href="?module=kamar_kotor" class="nav-link">Room Cleaning</a></li>
            <li><a href="?module=tambah_pesanan" class="nav-link">Order Service / Product</a></li>
          </ul>
        </div>
      </li>
      <li class="header">ADMINISTRASI</li>
      <li class="nav-item">
        <a href="#kamar" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-bed"></i>
          <span>Room</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="kamar">
          <ul>
            <li><a href="?module=lihat_kamar" class="nav-link">View Room</a></li>
            <li><a href="?module=tipe_kamar" class="nav-link">Room Type</a></li>
            <li><a href="?module=fasilitas" class="nav-link">Fasilitas</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#tamu" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-suitcase"></i>
          <span>Guest</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="tamu">
          <ul>
            <li><a href="?module=tamu" class="nav-link">View Guest</a></li>
            <li><a href="?module=tambah_tamu" class="nav-link">Add Guests</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#laundry" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-list"></i>
          <span>Laundry</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="laundry">
          <ul>
            <li><a href="?module=laundry" class="nav-link">View Laundry</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#user" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-user"></i>
          <span>User</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="user">
          <ul>
            <li><a href="?module=user" class="nav-link">View User</a></li>
            <li><a href="?module=tambah_user" class="nav-link">Add User</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#perusahaan" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-building"></i>
          <span>Perusahaan</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="perusahaan">
          <ul>
            <li><a href="?module=perusahaan" class="nav-link">View / Update Company</a></li>
          </ul>
        </div>
      </li>
      <?php endif;?>

      <!--Sidebar Front Office-->
      <?php if($data_user['level'] == "Front Office") : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=dashboard" class="nav-link i">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#chek-in-out" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-key"></i>
          <span>Check In / Out</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="chek-in-out">
          <ul>
            <li><a href="?module=chek_in" class="nav-livk">Check In</a></li>
            <li><a href="?module=chek_out" class="nav-livk">Check Out</a></li>
          </ul>
        </div>
      </li>
      <li class="header">ADMINISTRASI</li>
      <li class="nav-item">
        <a href="#kamar" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-bed"></i>
          <span>Room</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="kamar">
          <ul>
            <li><a href="?module=lihat_kamar" class="nav-link">View Room</a></li>
            <li><a href="?module=tipe_kamar" class="nav-link">Room Type</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="#tamu" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-suitcase"></i>
          <span>Guest</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="tamu">
          <ul>
            <li><a href="?module=tamu" class="nav-link">View Guest</a></li>
            <li><a href="?module=tambah_tamu" class="nav-link">Add Guests</a></li>
          </ul>
        </div>
      </li>
      <?php endif;?>

      <!--Sidebar Room Service-->
      <?php if($data_user['level'] == 'Room Service') : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=dashboard" class="nav-link i">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#room-service" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-book"></i>
          <span>Room Service</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="room-service">
          <ul>
            <li><a href="?module=kamar_kotor" class="nav-link">Room Cleaning</a></li>
            <li><a href="?module=tambah_pesanan" class="nav-link">Order Service / Product</a></li>
          </ul>
        </div>
      </li>
      <?php endif;?>

      <!--Sidebar Laundry-->
      <?php if($data_user['level'] == 'Laundry') : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=dashboard" class="nav-link i">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#laundry" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-list"></i>
          <span>Laundry</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="laundry">
          <ul>
            <li><a href="?module=laundry" class="nav-link">View Laundry</a></li>
          </ul>
        </div>
      </li>
      <?php endif;?>

      <!--Waiter-->
      <?php if($data_user['level'] == "Waiter") : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=restaurant/home" class="nav-link i">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="?module=restaurant/tambah_pesanan" class="nav-link i">
          <i class="fas fa-utensils"></i>
          <span>Order Service</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="?module=restaurant/pesanan" class="nav-link i">
          <i class="fas fa-shopping-cart"></i>
          <span>Orders</span>
        </a>
      </li>
      <?php endif;?>

      <!--Admin Resto-->
      <?php if($data_user['level'] == 'Admin Resto') : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=restaurant/home" class="nav-link i">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="?module=restaurant/menu" class="nav-link i">
          <i class="fas fa-list-alt"></i>
          <span>Menu</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="?module=restaurant/meja" class="nav-link i">
          <i class="fas fa-rocket"></i>
          <span>Table</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="?module=restaurant/pesanan" class="nav-link i">
          <i class="fas fa-shopping-cart"></i>
          <span>Orders</span>
        </a>
      </li>
      <?php endif;?>

      <!--Kasir-->
      <?php if($data_user['level'] == 'Kasir') : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=restaurant/home" class="nav-link i">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="?module=restaurant/kasir" class="nav-link i">
          <i class="fas fa-sync-alt fa-spin"></i>
          <span>Transaksi</span>
        </a>
      </li>
      <?php endif;?>

      <!--Owner-->
      <?php if($data_user['level'] == 'Owner') : ?>
      <li class="header">NAVIGATION</li>
      <li class="nav-item">
        <a href="?module=restaurant/home" class="nav-link i">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#room-service" class="nav-link i" data-toggle="collapse">
          <i class="fas fa-exchange-alt"></i>
          <span>Report</span>
          <i class="fas fa-angle-left float-right"></i>
        </a>
        <div class="collapse" id="room-service">
          <ul>
            <li><a href="?module=lap_kamar" class="nav-link">Transaksi Room</a></li>
            <li><a href="?module=lap_resto" class="nav-link">Transaksi Restaurant</a></li>
            <li><a href="?module=lap_laundry" class="nav-link">Transaksi Laundry</a></li>
          </ul>
        </div>
      </li>
      <?php endif;?>

    </ul>
  </div>

<div id="wrapper">