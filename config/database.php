<?php
define("db_host", "localhost");
define("db_user", "root");
define("db_pass", "");
define("db_name", "perhotelan");

$conn =  mysqli_connect(db_host, db_user, db_pass);
if(!$conn){
    define("db_status", "error");
    $url = "server_error";
} else {
    $db = mysqli_select_db($conn, db_name);
    if(!$db){
        define("db_status", "error");
        $url = "db_error";
    } else {
        define("db_status", "success");
    }
    
}