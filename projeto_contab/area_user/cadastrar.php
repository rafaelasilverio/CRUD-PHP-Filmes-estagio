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
        <title>Cadastro de filmes</title>
        <?php
            if(empty($_SESSION["login"])){
                header("Location: ../index.php");
            }
            ?>
    </head>
    <body>
        <div class="container">
            <form action="processa_cadastro.php" enctype="multipart/form-data" method="POST">
                <fieldset class="form-group border p-3">
                <legend class="display-6">Cadastre seu filme</legend><br>

                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Informe o nome do filme" required><br>

                    <label class="form-label">Gênero</label>
                    <select class="form-select" name="selecionar_genero">
                        <option>Selecione o gênero</option>
                            <?php
                                $selecionar_genero = "SELECT * FROM generos_filme";
                                $query_result_genero = mysqli_query($conexao, $selecionar_genero);
                                while($rows_generos = mysqli_fetch_assoc($query_result_genero)){ 
                            ?>
                        <option value="<?php echo $rows_generos['id']; ?>">
                                       <?php echo $rows_generos['genero']; ?>
                        </option>
                        <?php }  
                        mysqli_close($conexao);?>
                                  
                    </select><br>

                    <label class="form-label">Nota</label>
                    <input type="number" class="form-control" name="nota" placeholder="Atribua uma nota ao filme" max="10" required><br>

                    <label class="form-label">Data</label>
                    <input type="date" class="form-control" name="data" required><br>

                    <label class="form-label">Capa do filme</label>
                    <input type="file" class="form-control" name="foto" required><br>

                    <label class="form-check-label">Assistiria novamente?</label><br>
                    <input type="radio" class="form-check-input" name="assistir_novamente" value="sim" required>
                    <label class="form-check-label">Sim</label>
                    <input type="radio" class="form-check-input" name="assistir_novamente" value="nao" required>
                    <label>Não</label><br><br>
                    
                    <label class="form-label">Características específicas:</label><br>
                    <input type="checkbox" class="form-check-input" name="emocionante" value="1">
                    <label class="form-check-label">Emocionante</label>

                    <input type="checkbox" class="form-check-input" name="monotono" value="1">
                    <label class="form-check-label">Monótono</label>

                    <input type="checkbox" class="form-check-input" name="engracado" value="1">
                    <label class="form-check-label">Engraçado</label><br><br>

                    <label class="form-label">Observações:</label><br>
                    <textarea class="form-control" name="obs" id="" cols="40" rows="5" required></textarea><br>
                    
                    <div class="d-grid gap-2 d-md-block">
                        <button type="submit" class="btn btn-success" name="acessar" value ="acessar">Cadastrar</button>
                        <input type='button' class="btn btn-secondary" onclick="window.location = 'index.php';" value="Voltar">
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>