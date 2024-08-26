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
            $img = $dados['img'];
            $_SESSION['login'] = [
                "title" => 'Bem-vindo!',
                'text' => '' . $_SESSION['usuario'],
                'imageUrl' => 'img/usuarios/' . $img,
                'imageWidth' => 200,
                'imageHeight' => 200,
                'background' => '#3A5A40',
                'color' => '#ffffff'
            ];
            header("Location: index.php");
        } else {
            echo "<script>alert('Senha incorreta.');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.');</script>";
    }
}
include "include.php";
?>
<link rel="stylesheet" href="css/login.css">

<body>
    <div class="container">
        <div class="login-section">
            <h1>Login</h1>
            <hr class="divider">
            <form method="post">
                <div class="form-group">
                    <div class="input-field">
                        <label for="email">Email</label> <i class="fas fa-envelope"></i>
                        <input type="text" name="email" id="email" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="senha">Senha</label> <i class="fas fa-lock"></i>
                        <input type="password" name="senha" id="senha" />
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="login">Entrar</button>
                </div>
            </form>
            <div class="center">
                <a href="crud/cadUsuario.php">Cadastre-se já</a>
            </div>
        </div>
        <div class="image-section"></div>
    </div>
    <script src="js/sweetalert.js"></script>
    <script>
        <?php if ($msg != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($msg) ?>
                )
            })
        <?php } ?>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.form-group input');
            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    this.parentElement.querySelector('label').classList.add('active');
                });
                input.addEventListener('blur', function () {
                    if (this.value === '') {
                        this.parentElement.querySelector('label').classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>

</html>