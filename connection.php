<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    //$dbname = "userRegistration"; 
    $dbname = "ecommercedb"; 
    $connect = mysqli_connect($servername, $username, $password, $dbname);

?>