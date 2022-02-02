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
        <title> Consultar filmes </title>
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
        
        $sqlconsulta =  "select * from filmes where codigo = '$codigo_filme' and codigo_usuario = '$codigo_usuario'";
        
        $resultado = mysqli_query($conexao, $sqlconsulta);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
            die('<b>Query Inválida:</b>' . @mysqli_error($conexao)); 
        } else {
            $num = mysqli_num_rows($resultado);
            if ($num==0){
                echo "<div class='container border p-3'>";
                echo "<b>Código: </b>não localizado!<br><br>";
                echo '<input type="button" class="btn btn-secondary" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
                echo "</div>";
            exit;		
            }else{
                $dados = mysqli_fetch_array($resultado);
            }
        } 
        $genero = $dados['genero'];
        $sqlconsulta_gen =  "SELECT * FROM generos_filme WHERE id = '$genero'";
        $resultado2 = mysqli_query($conexao, $sqlconsulta_gen);
        if (!$resultado2) {
            die('<b>Query Inválida:</b>' . @mysqli_error($conexao)); 
        } else {
                $dados2 = mysqli_fetch_array($resultado2);
                $genero_filme = $dados2['genero'];
        } 

        mysqli_close($conexao);
    ?>
    <div>
            <div class="container">
                <form action="">
                    <fieldset class="form-group border p-3">
                        <legend class="display-6">Consultar filme</legend>
                        <label class="form-label">Poster do filme</label><br>
                        <img height= 150 src="<?php echo $dados['poster']?>"><br>

                        <label class="form-label">Código do filme</label>
                        <input type="number" class="form-control" value="<?php echo $dados['codigo']; ?>" readonly ><br>

                        <label class="form-label">Nome do filme</label>
                        <input type="text" class="form-control" value="<?php echo $dados['nome']; ?>" readonly ><br>

                        <label class="form-label">Gênero do filme</label>
                        <input type="text" class="form-control" value="<?php echo $genero_filme; ?>" readonly ><br>

                        <label class="form-label">Sua nota</label>
                        <input type="number" class="form-control" value="<?php echo $dados['nota']; ?>" readonly ><br>

                        <label class="form-label">Data em que assistiu</label>
                        <input type="date" class="form-control" value="<?php echo $dados['data_assist']; ?>" readonly ><br>

                        <label class="form-label">Assistiria novamente?</label>
                        <input type="text" class="form-control" value="<?php echo $dados['assistir_novamente']; ?>" readonly ><br>
                        
                        <?php
                            if($dados['emocionante'] == 1) { 
                                $emocionante = "sim";
                            }else{
                                $emocionante = "não";
                            }
                            if($dados['monotono'] == 1) { 
                                $monotono = "sim";
                            }else{
                                $monotono = "não";
                            }
                            if($dados['engracado'] == 1) { 
                                $engracado = "sim";
                            }else{
                                $engracado = "não";
                            }
                        ?>

                        <label class="form-label">Características específicas:</label><br>
                        <label class="form-label">Filme emocionante?</label>
                        <input type="text" class="form-control" value="<?php echo $emocionante; ?>" readonly ><br>
        
                        <label class="form-label">Filme monótono?</label>
                        <input type="text" class="form-control" value="<?php echo $monotono; ?>" readonly ><br>

                        <label class="form-label">Filme engraçado?</label>
                        <input type="text" class="form-control" value="<?php echo $engracado; ?>" readonly ><br>

                        <label class="form-label">Observações</label>
                        <input type="text" class="form-control" value="<?php echo $dados['observacoes']; ?>" readonly ><br>
 
                        <div class="d-grid gap-2 d-md-block">
                            <input type='button' class="btn btn-secondary" onclick="window.location = 'index.php';" value="Voltar">
                         </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>