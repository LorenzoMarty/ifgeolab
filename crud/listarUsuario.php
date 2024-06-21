<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script src="../js/dark-light.js"></script>
    <title>IF GeoLab</title>
    <style>
        .minha-imagem {
            height: 220px;
            width: 600px;
            object-fit: cover;
        }

        .meu-span {
            background-color: rgba(0, 0, 0, 0.3);
            width: 100%;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            header('Location: ../index.php');
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        header('Location: ../index.php');
    }
    ?>
    <main>

        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="left">Usuários</h3><br>
                </div>

                <div class="col s12">
                    <hr>
                    <p>Usuários cadastrados no IF GeoLab</p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM usuario";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql);
                while ($dados = mysqli_fetch_array($resultado)) {
                    $idusuario = $dados["idusuario"];
                    $nome = $dados['nome'];
                    $img = $dados['img'];
                ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-image">
                                <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed">
                                <span class="card-title center meu-span white-text text-lighten-3">
                                    <?php echo $nome ?>
                                </span>
                            </div>
                            <div class="card-action green darken-4">
                                <a id="btnExcluir-<?= $idusuario ?>" class="center waves-effect waves-light btn-small red" data-idusuario="<?= $idusuario ?>">Excluir</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <br>
                <br>

            </div>

        </div>
        <br><br><br>
    </main>

    <?php
    include "footer.php";
    ?>
    <script src="../js/sweetalert.js"></script>
    <script>
        document.querySelectorAll('[id^="btnExcluir-"]').forEach(button => {
            button.addEventListener('click', function() {
                const idusuario = this.getAttribute('data-idusuario');
                Swal.fire({
                    title: "Tem certeza que deseja excluir a conta?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "excluir.php?deletarUsuario=" + idusuario;
                    }
                });
            });
        });
    </script>

</body>

</html>