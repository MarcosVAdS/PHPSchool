<?php
    require '../models/nota.php';

    $nota = new nota();

    $saida = $nota->inserir();
    echo $saida;
?>