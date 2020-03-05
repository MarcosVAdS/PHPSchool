<?php
    require("models/nota.php");

    $nota = new nota();

    $saida = $nota->fetch_all();
    $notas = array();
    while($row = $notas->fetch_assoc()) {
        array_push($notas, $row);
    }
    echo($sql->error);
    echo ($notas);
?>