<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "reeltik";


    $con = mysqli_connect($host,$user,$password,$dbname);
    if(!$con){
        die("the resion : " . mysqli_connect_error());
    }
?>