<?php
    $valornota = $_POST['valornota'];
    $disciplina = $_POST['disciplina'];
    $aluno = $_POST['aluno'];

    require '../models/nota.php';

    $nota = new nota();

    $saida = $_POST->inserir();
    echo $saida;
?>