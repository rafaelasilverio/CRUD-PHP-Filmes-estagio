<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head lang="pt-br">
        <meta charset="utf8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Editar filme</title>
        <?php
            if(empty($_SESSION["login"])){
                header("Location: ../index.php");
            }
        ?>
    </head>
    <body>
    <div style="position: absolute; height: 116px; top: 40%; width: 100%; left: 0;">
        <div style="position: relative; height: 116px; top: -58px;">
            <div class="container">
                <form action="confirma_edicao.php" method="POST">
                <fieldset class="form-group border p-3">
                <legend class="display-6">Editar filme</legend><br>
                    <label class="form-label">Informe o código do filme que deseja editar:</label><br>
                    <input type="number"class="form-control" name="codigo_filme" placeholder="Ex: 3 " required><br>
                    <div class="d-grid gap-2 d-md-block">
                        <button type="submit" class="btn btn-success" name="editar" value ="editar">Editar</button>
                        <input type='button' class="btn btn-secondary" onclick="window.location = 'index.php';" value="Voltar">
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>