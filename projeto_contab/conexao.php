<?php
    $host = "localhost";
    $user = "root";
    $senha = "";
    $banco = "projeto";

    $conexao = mysqli_connect($host, $user, $senha, $banco)
    or die("Problemas na conexão com o banco de dados");
    mysqli_set_charset($conexao, "utf8");
?>