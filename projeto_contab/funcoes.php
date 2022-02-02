<?php

/* include_once("conexao.php");

    function logar($login, $senha){
            
            $sql = "select * from usuarios where login = '$login' and senha = '".md5($senha)."' ";
            $result = mysqli_query($conexao, $sql);
            $dados = mysqli_fetch_array($result);
            if($dados == 0){
                echo "O usuário informado não está cadastrado!<br><br>"; 
                // echo '<input type="button" onclick="window.location='."'cadastro.php'".';" value="Cadastrar-se"><br><br>';
            }else{
                $login = $dados["login"];
                session_start();
                $_SESSION["login"] = $login;
                header("Location: area_user");
            }
    } */
?>