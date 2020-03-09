<?php
    require("models/nota.php");

    $notas = new nota();
    
    $saida = $notas->fetch_all();
    $json = array();
    while($row = $saida->fetch_assoc()) {
        array_push($json, $row);
    }
    echo json_encode($json);
?>