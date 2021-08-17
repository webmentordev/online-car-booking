<?php 
    //Details
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'carshowroom';
    $port = 3306;

    //DB_connection_function
    $con = mysqli_connect($host, $user, $pass, $dbname, $port);

    /*Checking If Connected or Not
    if($con){
        echo "Database Conncted";
    }else{
        echo "Error Connecting Database";
    }*/
?>