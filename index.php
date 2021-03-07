<?php
session_start();

//load database
require_once("config/database.php");

//membuat kondisi jika database tidak error maka akan
//diarahkan ke halaman login
if(db_status == "success"){
    if(empty($_SESSION["get"])){
        include "login.php";
    } else {
        include "template/index.php";
    }

} else {
    include "error/index.php";
}