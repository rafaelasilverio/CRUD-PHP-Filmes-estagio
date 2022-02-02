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
            $codigo_filme = mysqli_escape_string($conexao,$_POST['codigo_filme']);
            $nome = mysqli_escape_string($conexao,$_POST['nome']);
            $genero = mysqli_escape_string($conexao,$_POST['selecionar_genero']);
            $nota = mysqli_escape_string($conexao,$_POST['nota']);
            $data_assist = mysqli_escape_string($conexao,$_POST['data_assist']);
            $assistir_novamente = mysqli_escape_string($conexao,$_POST['assistir_novamente']);
            $observacoes = mysqli_escape_string($conexao,$_POST['obs']);
            $codigo_usuario = mysqli_escape_string($conexao,$_SESSION["codigo_usuario"]);
        
            //checkbox
            if(!isset($_POST['emocionante'])){
                $emocionante = 2;
            }else{
                $emocionante = mysqli_escape_string($conexao,$_POST['emocionante']);
            }
            
            if(!isset($_POST['monotono'])){
                $monotono = 2;
            }else{
                $monotono = mysqli_escape_string($conexao,$_POST['monotono']);
            }

            if(!isset($_POST['engracado'])){
                $engracado = 2;
            }else{
                $engracado = mysqli_escape_string($conexao,$_POST['engracado']);
            }

        /*  editar imagem
            if(isset($_FILES['foto'])){
                $poster = $_FILES['foto'];

            if($poster['error'])
                die("Falha ao enviar imagem");

            if($poster['size'] > 2097152)
                die("Arquivo muito grande! Max: 2MB");

            $pasta = 'arquivos/';
            $nomeDoArquivo = $poster['name'];
            $novoNomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
            
            if($extensao != 'jpg' && $extensao != 'png'){
                die("Tipo de arquivo não aceito! (apenas .jpg ou .png)");
            }

            $caminho = $pasta . $novoNomeDoArquivo . "." . $extensao;

            // echo $codigo_filme . " - " . $nome . " - ". $genero . " - " . $nota . " - " . $data_assist . " - " . $assistir_novamente . " - " . $observacoes . " - " . $codigo_usuario . " - " . $caminho . " - " . $emocionante . " - " . $monotono . " - " . $engracado;
            $arquivo_salvo = move_uploaded_file($poster["tmp_name"], $pasta . $novoNomeDoArquivo . "." . $extensao);

            if($arquivo_salvo){ */
                
                $update_filme = "UPDATE filmes SET nome='$nome', genero='$genero', nota='$nota', data_assist='$data_assist',
                assistir_novamente='$assistir_novamente', emocionante='$emocionante', monotono='$monotono',
                engracado='$engracado', observacoes ='$observacoes' WHERE codigo=$codigo_filme AND codigo_usuario=$codigo_usuario";

            
                $resultado = mysqli_query($conexao, $update_filme);
                if (!$resultado) {
                    echo '<input type="button" onclick="window.location=' . "'index.php'" . ';" value="Voltar"><br><br>';
                    die('<b>Query Inválida:</b>' . @mysqli_error($conexao));
                } else {
                    echo "Filme atualizado com sucesso!";
                }
                mysqli_close($conexao);
                
        /*     }else{
                echo "<p>Falha no salvamento da foto</p>";
            } 
        }  */
        ?>
        <br><br>
        <input type='button' onclick="window.location = 'editar.php';" value="Voltar">
    </body>
</html>