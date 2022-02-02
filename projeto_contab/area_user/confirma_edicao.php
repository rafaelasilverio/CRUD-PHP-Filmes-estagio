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
    <title> Editar Filmes </title>
    <?php
        if(empty($_SESSION["login"])){
            header("Location: ../index.php");
        }
     ?>
</head>
    <body>
    <?php
        if(isset($_GET['codigo'])){
            $codigo_filme = mysqli_escape_string($conexao, $_GET['codigo']);
        }else{
            $codigo_filme = mysqli_escape_string($conexao,$_POST['codigo_filme']);
        }
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
                $dados=mysqli_fetch_array($resultado);
            }
        }
    ?>
            <div class="container">
                <form action="processa_edicao.php" method="POST" enctype="multipart/form-data">
                <fieldset class="form-group border p-3">
                    <legend class="display-6">Deseja editar este filme?</legend>
                        <label class="form-label">Código do filme</label>
                        <input type="hidden" class="form-control" name="codigo_filme" value="<?php echo $dados['codigo']; ?>"><br>     

                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $dados['nome']; ?>"><br>

                        <label class="form-label">Gênero</label>
                        <select class="form-select" name="selecionar_genero" required>
                            <option>Selecione</option>
                                <?php
                                    $selecionar_genero = "SELECT * FROM generos_filme";
                                    $query_result_genero = mysqli_query($conexao, $selecionar_genero);
                                    ?>
                                <?php
                                    while($rows_generos = mysqli_fetch_assoc($query_result_genero)){ 
                                ?>
                            <option value="<?php echo $rows_generos['id']; ?>">
                                        <?php echo $rows_generos['genero']; ?>
                            </option>
                            <?php } ?>
                                    
                        </select><br>

                        <label class="form-label">Nota</label>
                        <input type="number" class="form-control" name="nota" value="<?php echo $dados['nota']; ?>"><br>

                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" name="data_assist" value="<?php echo $dados['data_assist']; ?>"><br>

                        <label class="form-label">Capa do filme</label><br>
                        <img height= 150  src="<?php echo $dados['poster']?>"><br>

                        <?php
                            if($dados['assistir_novamente'] == 'sim') { ?>
                            <label class="form-label">Assistiria novamente?</label><br>
                            <input type="radio" checked name="assistir_novamente" value="sim" required>
                            <label class="form-label">Sim</label>
                            <input type="radio" name="assistir_novamente" value="nao" required>
                            <label class="form-label">Não</label><br><br>
                        <?php
                            }else{ ?>
                            <label class="form-label">Assistiria novamente?</label><br>
                            <input type="radio"  name="assistir_novamente" value="sim" required>
                            <label class="form-label">Sim</label>
                            <input type="radio" checked name="assistir_novamente" value="nao" required>
                            <label class="form-label">Não</label><br><br>
                          <?php 
                           }
                         ?>

                        <?php
                            if($dados['emocionante'] == 1) { 
                                $check1 = 'checked';
                            }else{
                                $check1 = '';
                            }
                            if($dados['monotono'] == 1) {  
                                $check2 = 'checked';
                            }else{                             
                                $check2 = '';
                            }
                            if($dados['engracado'] == 1) { 
                                $check3 = 'checked';
                            }else{
                                $check3 = '';
                            }
                        ?>
        
                        <label>Características específicas</label><br>
                        <input type="checkbox" <?php echo $check1 ?> class="form-check-input" name="emocionante" value="1">
                        <label class="form-check-label">Emocionante</label><br>

                        <input type="checkbox" <?php echo $check2 ?> class="form-check-input" name="monotono" value="1">
                        <label class="form-check-label">Monótono</label><br>

                        <input type="checkbox" <?php echo $check3 ?> class="form-check-input" name="engracado" value="1">
                        <label class="form-check-label">Engraçado</label><br><br>

                        <label>Observações:</label><br>
                        <input type="text" name="obs" class="form-control" id="" cols="40" rows="5" value="<?php echo $dados['observacoes']; ?>"><br>
                        
                        <div class="d-grid gap-2 d-md-block">
                            <button type="submit" class="btn btn-success" name="acessar" value ="acessar">Editar</button>
                            <button type='button' class="btn btn-secondary" onclick="window.location = 'index.php';" value="Voltar">Voltar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        
        <?php mysqli_close($conexao); ?>
    </body>
</html>

