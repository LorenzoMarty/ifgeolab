<?php
session_start();
if (isset($_POST['login'])) {

    require_once('conecta.php');
    $conexao = conectar();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['usuario'] = $dados['nome'];
            $_SESSION['senha'] = $senha;
            $_SESSION['email'] = $email;
            $_SESSION['permissao'] = $dados['tipo'];
            $_SESSION['id'] = $dados['idusuario'];
            header("location:index.php");
        }
    } else {
        echo "alert('Usuário e/ou senha incorreto(s)')";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
    <title>Login</title>
    <style>
        .center {
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    include "topo.php";
    ?>
    <main>

        <body>
            <div class="container">
                <div class="col s6 center">
                    <h1> Login </h1>
                    <hr>

                    <form method="post">
                        <div class="input-field col s6">
                            <label> Email </label>
                            <input type="text" name="email" />
                        </div>
                        <div class="input-field col s6">
                            <label> Senha </label>
                            <input type="password" name="senha" />
                        </div>
                </div>
                <div class="input-field col s6">
                    <button class="waves-effect waves-light btn green darken-4" type="submit" name="login"> Logar </button>
                </div>
                </form>
                <div class="center">
                    <p>Não tem uma conta?<a href="crud/cadUsuario.php">Cadastre-se!</a></p>
                </div>
            </div>
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <?php
    include "footer.php";
    ?>
</body>

</html>