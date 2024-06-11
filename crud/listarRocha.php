<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
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

        .btn {
            font-size: 10px;
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
        <div class="container">
            <div class="row col s12">
                <h3 class="left">Rochas</h3>
            </div>
            <hr>
            <p>Rocha é um agregado sólido que ocorre naturalmente e é constituído por um ou mais minerais ou
                mineraloides. A camada externa sólida da Terra, conhecida por litosfera, é constituída por rochas. </p>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM rocha WHERE sugestao=0";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql);
                while ($dados = mysqli_fetch_array($resultado)) {
                    $idrocha = $dados["idrocha"];
                    $nome = $dados['nome'];
                    $cat = $dados['idcat'];
                    $descricao = $dados['descricao'];
                    $img = $dados['img'];
                ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-image">
                                <img src="../img/rochas/<?= $img; ?>" class="minha-imagem materialboxed">
                                <span class="card-title center meu-span white-text">
                                    <?php echo $nome ?>
                                </span>
                            </div>
                            <div class="card-action green darken-4">
                                <a class="center waves-effect waves-light btn-small green accent-4" href="../relatorio.php?idrocha=<?php echo $idrocha; ?>">
                                    <img src="../img/pdf-icon.png">
                                </a>
                                <a id="btnExcluir-<?= $idrocha ?>" class="center waves-effect waves-light btn-small red" data-idrocha="<?= $idrocha ?>">Excluir</a>
                                <a class="center waves-effect waves-light btn-small green" href="editRocha.php?idrocha=<?= $idrocha; ?>&sugestao=0">Editar</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col s12 l4 m8">
                    <div class="card hoverable">
                        <div class="card-action center green darken-4">
                            <a class="center waves-effect waves-light btn-small green accent-4" href="cadRocha.php">Cadastrar</a>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                </div>
                </main>
                <?php
                include "footer.php";
                ?>
                <script src="../js/sweetalert.js"></script>
                <script>
                    document.querySelectorAll('[id^="btnExcluir-"]').forEach(button => {
                        button.addEventListener('click', function() {
                            const idrocha = this.getAttribute('data-idrocha');
                            Swal.fire({
                                title: "Tem certeza que deseja excluir a conta?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Sim"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = "excluir.php?deletarRocha=" + idrocha;
                                }
                            });
                        });
                    });
                </script>
</body>

</html>