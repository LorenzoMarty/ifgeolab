<?php

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST['login'])) {

    require_once('conecta.php');

    $usuario = $_POST['usuario'];

    $sql = "SELECT * FROM usuario WHERE email='$usuario'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // executa o php mailer com a senha
        $banco_usuario = mysqli_fetch_assoc($resultado);
        $banco_email = $banco_usuario['email'];

        $email = new PHPMailer();
$email->isSMTP();
$email->Host = "smtp.gmail.com";
$email->SMTPAuth = "true";

$email->Charset = 'UTF-8';

$email->SMTPSecure = "tls";
$email->Port ="587";

$email->Username = "bernardo.2021319283@aluno.iffar.edu.br";
$email->Password = "07012006";

//titulo do email
$email->Subject = 'Mensagem automatica - Recuperar senha';
$email->setFrom("$banco_email");
$email->Body =
" Olá $usuario, 
    Você solicitou o serviço de redefinição de senha. Por favor, clique no link para redefinir sua senha:
    <a href=http://localhost/tccbernardo/alterar-senha.php>Redefinir Senha</a><br><br>
Atenciosamente, São José!";    

$email->AltBody = '<a href=http://localhost/tccbernardo/alterar-senha.php>Redefinir Senha</a><br><br>
Atenciosamente, São José!';

$email->addAddress("$banco_email");
if($email->Send()){
    echo"Email envidado";
    $_SESSION['id_recuperar'] = $banco_usuario['id'];
}else{
    echo "nao enviado".$email->ErrorInfo;
}
$email->smtpClose();





    } else {
        echo "deu ruim";
    }
}
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">


    <title>Recuperação de Senha</title>
    <style>
        body {

            background-image: url(imagens/exemplo3.png);

        }

        #login {

            display: flex;
            /*     centraliza no meio da página        */

            align-items: center;
            /* centralizar itens */

            justify-content: center;
            /* coloca bem ao meio */

            height: 92vh;
            ;

            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;

        }

        .formulario {

            background-color: rgba(19, 19, 19, 0.3);
            /* cor de fundo do formulario de login */

            padding: 40px;
            /* tamanho das bordas */

            border-radius: 2px;

            width: 280px;
            /* largura do fundo */

        }

        .titleLogin {


            padding-bottom: 50px;

            opacity: 0.8;

            color: #fff;
            /* cor do titulo de login */

        }

        .conteudoUsuario {

            color: #fff;
            /* cor de email e senha */

            opacity: 0.8;
            /* opacidade da cor do email e senha */

        }

        .card-content-area {

            display: flex;
            /* joga as linhas para baixo além de distanciar o "login" e o esqueci minha senha */

            flex-direction: column;

            padding: 15px 0;
            /* distancia das escritas */

        }

        .card-content-area input {

            margin-top: 10px;

            padding: 0 5px;

            background-color: transparent;
            /* em vez de ser colunas deixa como linhas */

            border: none;
            /* deixa sem bordas na parte de inserir seus dados */

            border-bottom: 1px solid #e1e1e1;
            /* mostra as linhas tamanho e suas cores */

            outline: none;

            color: #fff;


        }

        .card-footer {

            display: flex;
            /* centraliza o esqueci minha senha */

            flex-direction: column;

        }

        .card-footer .submit {

            width: 100%;
            /* tamanho do botão de login */

            height: 40px;
            /* comprimento do botão */

            background-color: rgb(124, 57, 57);
            /* cor do botão do login */

            border: none;
            /* deixa o botão sem bordas */

            color: #e1e1e1;
            /* cor da letra do login */

            margin: 10px 0;

        }

        .card-footer a {

            text-align: center;

            font-size: 12px;

            opacity: 0.8;

            color: #fff;



        }
    </style>

</head>

<body>
    <br> <br> <br>
    <div id="login">

        <form method="POST" class="formulario">

            <div class="titleLogin">

                <h2>Recuperação de Senha</h2>
            </div>

            <div class="conteudoUsuario">

                <div class="card-content-area">

                    <label for="usuario">Digite seu usuário para recuperar sua senha:</label>

                    <input type="usuario" name="usuario" class="validate" id="usuario" autocomplete="off">
                </div>
                <div class="card-footer">
                    <input type="submit" name="login" value="login" class="submit">
                </div>

        </form>

    </div>

</body>

</html>