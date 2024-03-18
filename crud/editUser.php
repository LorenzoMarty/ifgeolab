<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <title>Perfil</title>
    <style>
        .minha-imagem {
            height: 300px;
            width: 300px;
            object-fit: cover;
        }

        .meu-span {
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
        }
        .icon{
            height: 32px;
            width: 32px;
            align-items: center;
            position:absolute;
        }
        .btn2{
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <main>
        <?php
        if (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 1) {
            include "topo-user.php";
        } elseif (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 2) {
            include "topo-adm.php";
        } else {
            include "topo.php";
        }
        ?>
        <?php

        include_once('../conecta.php');
        $conexao = conectar();
        $idusuario = $_COOKIE['acesso']['id'];

        $sql = "SELECT * FROM usuario WHERE idusuario =" . $idusuario;
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $dados = mysqli_fetch_assoc($resultado);
            $img = $dados['img'];
            $user = $dados['idusuario'];
        }


        ?>
        <div class="container">
            <div class="row">
                <div class="col s6">
                    <h3 class="left">Meu Perfil</h3>
                </div>
                <div class="col s6">
                    <div class="right hide-on-med-and-down" style="margin-top: 50px;">
                    <a class="waves-effect waves-light btn green accent-4" href="formEdit.php?editar='<? $idusuario ?>'"> Editar</a>
                    <a class="waves-effect waves-light btn red lighten-5 red-text" href="../sair.php">Sair</a>
                    <a class="waves-effect waves-light btn red" href="processaUsuario.php?deletar=<?= $user; ?>">Excluir</a>
                    </div>
                </div>
            </div>
            <hr>
            <br><br>
            <div class="row">
                <div class="col s6">
                    <div class="card-image">
                        <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed ">
                    </div>
                </div>
                <div class="col s6">
                    <h5><b>Nome: </b><?php echo $dados['nome']; ?></h5><br>
                    <h5><b>Email: </b><?php echo $dados['email']; ?></h5><br>
                    <h5><b>Telefone: </b><?php echo $dados['telefone']; ?></h5><br>
                    <h5><b>Matrícula: </b><?php echo $dados['matricula']; ?></h5><br>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <?php
    include "footer.php";
    ?>
</body>

</html>