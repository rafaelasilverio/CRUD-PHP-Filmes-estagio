<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head lang="pt-br">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <title>Gerenciador de filmes</title>
            <?php
                if(empty($_SESSION["login"])){
                    header("Location: ../index.php");
                }
            ?>
    </head>
    <body>
    <div style="position: absolute; height: 116px; top: 25%; width: 100%; left: 0;">
            <div style="position: relative; height: 116px; top: -58px;">
                <div class="text-center">
                    <div class="container border p-3">
                        <h6>Bem vindo <?php echo $_SESSION["login"] ?> !</h6>
                        <h3 class="display-6">Escolha o que deseja fazer</h3><br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="cadastrar.php" class="btn btn-outline-secondary">Cadastrar</a>
                            <a href="consultar.php" class="btn btn-outline-secondary">Consultar</a>
                            <a href="consulta_geral.php" class="btn btn-outline-secondary">Todos os filmes</a>
                            <a href="editar.php" class="btn btn-outline-secondary">Editar</a>
                            <a href="excluir.php" class="btn btn-outline-secondary">Excluir</a>
                            <a href="sair.php" class="btn btn-outline-danger">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>