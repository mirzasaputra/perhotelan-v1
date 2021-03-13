<nav class="navbar navbar-expand navbar-dark bg-primary navbar-static-top">
    <div class="navbar-header">
        <a href="" class="navbar-brand nav-link"><?=$data_perusahaan['nama_hotel'];?><div class="small"><small><?=$data_perusahaan['nama_perusahaan'];?></small></div></a>
    </div>
    <ul class="navbar-nav d-inline-block ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" id="alertDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="assets/img/<?=$data_user['image'];?>" alt="" class="img-circle img-adm">
                <span><?=$data_user['level'];?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-img">
                    <img src="assets/img/<?=$data_user['image'];?>" alt="" class="img-circle">
                </div>
                <div class="dropdown-footer">
                    <button class="btn btn-default btn-flat float-left">Profile</button>
                    <button id="logout" class="btn btn-default btn-flat float-right">Log Out</button>
                </div>
            </div>
        </li>
    </ul>
</nav>
<div id="wrapper-content">