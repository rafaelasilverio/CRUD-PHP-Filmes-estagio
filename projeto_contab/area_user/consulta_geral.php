<?php
    include_once("../conexao.php");
    session_start();
?>
<!DOCTYPE html>
<html>
<head lang="pt-br">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Todos os filmes</title>
    <?php
        if(empty($_SESSION["login"])){
            header("Location: ../index.php");
        }
     ?>
</head>
<body>
    <div style="position: absolute; height: 116px; top: 20%; width: 100%; left: 0;">
    <div style="position: relative; height: 116px; top: -58px;">
    <?php
        $codigo_usuario = $_SESSION["codigo_usuario"];

        $query = mysqli_query($conexao,"select codigo, nome, data_assist from filmes where codigo_usuario = '$codigo_usuario' order by data_assist desc");

        if (!$query) {
            echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
            die('<b>Query Inválida:</b>' . @mysqli_error($conexao));  
        }
        echo "<div class='container border p-3'>";
        echo " <p class='display-6 text-center'>Todos os filmes</p>";
        echo "<table class='table'>";
        echo "<tr class='text-center'><th scope='col'>Código</th>
        <th scope='col'>Nome</th>
        <th scope='col'>Data</th>
        <tr>";
        
        while($dados = mysqli_fetch_array($query)){      
        echo "</tr>";
        echo "<td align = 'center'>" . $dados['codigo'] . "</td>";
        echo "<td align = 'center'>". $dados['nome'] . "</td>";
        echo "<td align = 'center'>". date("d/m/Y", strtotime($dados['data_assist'])) . "</td>";
        echo "<td align = 'center'><a href='confirma_edicao.php?codigo=" . $dados['codigo'] ."' class='btn btn-secondary btn-sm'>Editar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
        mysqli_close($conexao);

    ?>
            <div class="d-grid gap-2 d-md-block">
                <input type='button' class="btn btn-secondary" onclick="window.location = 'index.php';" value="Voltar">
            </div>
        </div>
      </div>
    </div>
</body>
</html>