<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <title>IF GeoLab</title>
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

        .icon {
            height: 32px;
            width: 32px;
            align-items: center;
            position: absolute;
        }

        .btn2 {
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <main>
        <?php

        if (isset($_SESSION['permissao'])) {
            if ($_SESSION['permissao'] == 1) {
                include "topo-user.php";
            } elseif ($_SESSION['permissao'] == 2) {
                include "topo-adm.php";
            }
        } else {
            header('Location: ../index.php');
        }
        ?>
        <?php

        require_once ('../conecta.php');
        $conexao = conectar();
        $idusuario = $_SESSION['id'];

        $sql = "SELECT * FROM usuario WHERE idusuario =" . $idusuario;
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $dados = mysqli_fetch_assoc($resultado);
            $img = $dados['img'];
            $user = $dados['idusuario'];
        }
        $sqlAmostra = "SELECT 
        usuario.nome, 
        GROUP_CONCAT(DISTINCT mineral.nome ORDER BY mineral.nome SEPARATOR ', ') AS nomes_minerais,
        GROUP_CONCAT(DISTINCT rocha.nome ORDER BY rocha.nome SEPARATOR ', ') AS nomes_rochas
    FROM 
        usuario
    LEFT JOIN 
        mineral ON usuario.idusuario = mineral.idusuario
    LEFT JOIN 
        rocha ON usuario.idusuario = rocha.idusuario
    WHERE 
        usuario.idusuario = $idusuario
    GROUP BY 
        usuario.nome;
    ";
    $result = mysqli_query($conexao, $sqlAmostra);
    if (mysqli_num_rows($result) > 0) {
        $amostra = mysqli_fetch_assoc($result);
        $mineraisCad = $amostra['nomes_minerais'];
        $rochasCad = $amostra['nomes_rochas'];
    }

            ?>
        <div class="container">
            <div class="row">
                <div class="col s6">
                    <h3 class="left">Meu Perfil</h3>
                </div>
                <div class="col s6">
                    <div class="right hide-on-med-and-down" style="margin-top: 50px;">
                        <a class="waves-effect waves-light btn green accent-4" href="formEdit.php"> Editar</a>
                        <a id="btnSair" class="waves-effect waves-light btn red lighten-5 red-text">Sair</a>
                        <a id="btnExcluir" class="waves-effect waves-light btn red">Excluir</a>
                    </div>
                </div>
            </div>
            <hr>
            <br><br>
            <div class="row">
                <div class="col s6">
                    <div class="card-image">
                        <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed circle">
                    </div>
                </div>
                <div class="col s6">
                    <h5><b>Nome: </b><?php echo $dados['nome']; ?></h5><br>
                    <h5><b>Email: </b><?php echo $dados['email']; ?></h5><br>
                    <h5><b>Telefone: </b><?php echo $dados['telefone']; ?></h5><br>
                    <h5><b>Matrícula: </b><?php echo $dados['matricula']; ?></h5><br>
                    <h5><b>Instituição: </b><?php echo $dados['instituto']; ?></h5><br>
                    <?php if($amostra['nomes_minerais'] == ""){}else{ 
                        echo "<h5><b>Minerais Cadastrados: </b>".$mineraisCad."</h5><br>"; }
                    if($amostra['nomes_rochas'] == ""){}else{
                        echo "<h5><b>Rochas Cadastrados: </b>".$rochasCad."</h5><br>"; }?>
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
    <script src="../js/sweetalert.js"></script>
    <script>
        const btnSair = document.querySelector('#btnSair');
        btnSair.addEventListener('click', function () {
            Swal.fire({
                title: "Tem certeza que deseja sair?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "../sair.php";
                }
            });
        });

        const btnExcluir = document.querySelector('#btnExcluir');
        btnExcluir.addEventListener('click', function () {
            Swal.fire({
                title: "Tem certeza que deseja excluir a conta?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "excluir.php?deletarUsuario=<?= $user; ?>"
                }
            });
        });
    </script>
</body>

</html>