<?php

$localhost = "localhost"; 
$username = "root"; 
$password = "p@\$\$w0rd"; 
$dbname = "school"; 

$connection = new mysqli($localhost, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else {
    echo 'conectado!';
}
?>