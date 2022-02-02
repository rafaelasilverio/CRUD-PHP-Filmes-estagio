<?php
    include_once("funcoes.php");
    include_once("conexao.php");
    session_start();
?>
<!DOCTYPE html>
<html>
<head lang="pt-br">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Página de login</title>
    </head>
    <body>
        <div style="position: absolute; height: 116px; top: 25%; width: 100%; left: 0;">
            <div style="position: relative; height: 116px; top: -58px;">
                <div class="container border p-3">
                    <form action="index.php" method="POST">
                        <label class="display-6">Entrar</label><br><br>
                        <label class="form-label">Login</label>
                            <input type="text" class="form-control" name="login" placeholder="Informe seu login" required>
                        <label>Senha</label>
                            <input type="password" class="form-control" name="senha" placeholder="Informe sua senha" required><br>
                        <div class="d-grid gap-2 d-md-block">
                            <button type="submit" class="btn btn-success" name="acessar" value ="acessar">Acessar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    if(isset($_POST["acessar"])){
        $login = mysqli_escape_string($conexao, $_POST["login"]);
        $senha = mysqli_escape_string($conexao, $_POST["senha"]);
        if(!empty($login) && !empty($senha)){ 
            $sql = "select * from usuarios where login = '$login' and senha = '".md5($senha)."' ";
            $result = mysqli_query($conexao, $sql);
            $dados = mysqli_fetch_array($result);
            if(empty($dados)){
                echo "O usuário informado não está cadastrado!<br><br>"; 
                // echo '<input type="button" onclick="window.location='."'cadastro.php'".';" value="Cadastrar-se"><br><br>';
            }else{
                $login = $dados["login"];
                $codigo_usuario = $dados["id"];
                session_start();
                $_SESSION["login"] = $login;
                $_SESSION["codigo_usuario"] = $codigo_usuario;
                header("Location: area_user");
            }
        }else{
            echo "<script>alert('Preencha todos os campos!')</script>";
        }
    }
?>
