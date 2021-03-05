<?php 
include '../../config/database.php';
$query = mysqli_query($conn, "SELECT * FROM tamu");
$no = 1;
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?module=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="card bg-light">
        <div class="card-header"><h4><i class="fas fa-suitcase"></i> Guest List</h4></div>
        <div class="card-body">
            <button class="btn btn-primary tambah"><i class="fas fa-plus"></i> Add Tamu</button>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table bordered table-hovered">
                    <thead>
                        <tr>
                            <th width='1%'>No.</th>
                            <th width="25%">Name</th>
                            <th>Type Identitas</th>
                            <th>No. Identitas</th>
                            <th width="25%">Address</th>
                            <th>No. Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if(mysqli_num_rows($query) > 0){ ?>
                    <?php while($i = mysqli_fetch_array($query)) : ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$i['prefix'].'. '.$i['nama_depan'].' '.$i['nama_belakang'];?></td>
                        <td><?=$i['tipe_identitas'];?></td>
                        <td><?=$i['no_identitas'];?></td>
                        <td><?='Jl. '.$i['jalan'].' No.'.$i['no_jalan'].' '.$i['kabupaten'].', '.$i['provinsi'];?></td>
                        <td><?=$i['no_telp'];?></td>
                        <td><div class="row"><button class="btn btn-danger hapus" value="<?=$i['id_tamu'];?>"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn btn-primary ml-1 edit" value="<?=$i['id_tamu'];?>"><i class="fas fa-edit"></i></button></div></td>
                    </tr>
                    <?php endwhile;?>
                    <?php } else { ?>
                        <td colspan='7'><div class="alert alert-danger">The are no guest staying, <a href="#" class="tambah" data-toggle="modal">Add</a>.</div></td>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>