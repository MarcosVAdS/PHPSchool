<?php

    $localhost = "localhost"; 
    $username = "root"; 
    $password = "p@\$\$w0rd"; 
    $dbname = "school"; 

    $connection = new mysqli($localhost, $username, $password, $dbname);

    if($connection->connect_error) {
        die("connection failed : " . $connection->connect_error);
    }
    else {
        var_dump('conectado!');
    }
?>