<?php
    include_once("../conexao.php");
    session_start();
?>
<!DOCTYPE html>
<html>
    <head lang="pt-br">
        <meta charset="utf8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title> Excluir Filmes </title>
        <?php
            if(empty($_SESSION["login"])){
                header("Location: ../index.php");
            }
        ?>
    </head>
    <body>
        <?php
            $codigo_filme = mysqli_escape_string($conexao,$_POST['codigo_filme']);
            $codigo_usuario = $_SESSION["codigo_usuario"];

            $sqldelete = "delete from filmes where codigo = '$codigo_filme' and codigo_usuario = '$codigo_usuario'";
            
            $resultado = mysqli_query($conexao, $sqldelete);
            if (!$resultado) {
                echo '<input type="button" onclick="window.location=' . "'index.php'" . ';" value="Voltar"><br><br>';
                die('<b>Query Inválida:</b>' . @mysqli_error($conexao));
            } else {
                echo "<div class='container border p-3'>";
                echo "<p>Filme excluído com sucesso!</p><br><br>";
                echo '<input type="button" class="btn btn-secondary" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
                echo "</div>";
            }
            mysqli_close($conexao);
        ?>
        <br><br>
    </div>
    </body>
</html>