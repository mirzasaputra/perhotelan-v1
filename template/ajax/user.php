<?php
include "../../config/database.php";

$query = mysqli_query($conn, "SELECT * FROM user WHERE status='petugas hotel'");
$no = 1;
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h4><i class="fas fa-user"></i> Data User</h4></div>
        <div class="card-body">
            <button class="btn btn-primary tambah"><i class="fas fa-plus"></i> Add User</button>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table bordered table-hovered">
                    <thead>
                        <tr>
                            <th width='1%'>No.</th>
                            <th width="25%">Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($query) > 0){ ?>
                        <?php while($i = mysqli_fetch_array($query)) : ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$i['nama_user'];?></td>
                            <td><?=$i['username'];?></td>
                            <td>**************</td>
                            <td><?=$i['level'];?></td>
                            <td><img src="assets/img/<?=$i['image'];?>" alt="" class="img-circle" style="width: 60PX"></td>
                            <td><div class="row"><button class="btn btn-danger hapus" value='<?=$i['id_user'];?>'><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary edit ml-1" value='<?=$i['id_user'];?>'><i class="fas fa-edit"></i></button></div></td>
                        </tr>
                        <?php endwhile;?>
                        <?php } else { ?>
                            <center><img src="assets/img/empty_cart.jpg" alt=""></center>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>