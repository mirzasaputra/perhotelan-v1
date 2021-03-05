<!DOCTYPE html>
<html>
    <head>
        <title>SERVER ERROR</title>
        <style>
            div.box {
                display: block;
                padding: 20px;
                background: #ebe9e9;
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 5%;
                box-shadow: 0rem .2rem 1rem .2rem rgba(0, 0, 0, .175);
            }
            div.box h1 {
                font-family: sans-serif;
                font-size: 20px;
                margin: 0;
                border-bottom: 2px solid rgba(200, 200, 200, 1);
                padding: 0 15px 10px; ;
                color: rgba(100, 100, 100, 1);
            }
            div.box p {
                font-family: sans-serif;
                font-size: 15px;
                color: rgba(100, 100, 100, 1);
            }
        </style>
    </head>
    <body>
        <?php if($url == "db_error") : ?>
        <div class="box">
            <h1>Database Error</h1>
            <p>Database <?=db_name;?> doesn't exists.</p>
        </div>
        <?php endif;?>
        <?php if($url == "server_error") : ?>
        <div class="box">
            <h1>Server Error</h1>
            <p>Server dengan username (<?=db_user;?>) dan password (<?=db_pass;?>) tidak ditemukan.</p>
        </div>
        <?php endif;?>
        <?php if(isset($_GET['not_found'])) : ?>
        <div class="box">
            <h1>File Tidak Ditemukan</h1>
            <p>Mohon maaf file yang anda akses tidak tersedia.</p>
        </div>
        <?php endif;?>
        <?php if(isset($_GET['forbiden'])) : ?>
        <div class="box">
            <h1>Access Denied</h1>
            <p>Mohon maaf file ini tidak bisa di akses.</p>
        </div>
        <?php endif;?>