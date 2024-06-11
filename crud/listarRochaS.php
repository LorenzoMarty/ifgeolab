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
    </style>
</head>

<body>
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
    <main>

        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="left">Rochas</h3><br>
                </div>

                <div class="col s12">
                    <hr>
                    <p>Rocha é um corpo natural sólido e cristalino formado em resultado da interação de processos
                        físico-químicos em ambientes geológicos. Cada rocha é classificado e denominado não apenas com
                        base na sua composição química, mas também na estrutura cristalina dos materiais que o compõem.
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM rocha WHERE sugestao=1";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql); ?>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th scope="col">Id Rocha</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Id Categoria</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <?php while ($dados = mysqli_fetch_array($resultado)) {
                        $idrocha = $dados["idrocha"];
                        $nome = $dados['nome'];
                        $cat = $dados['idcat'];
                        $descricao = $dados['descricao'];
                        $img = $dados['img'];
                        $obj = $dados['3d'];

                        echo "<td> " . $dados['idrocha'] . " </td>";
                        echo "<td>" . $dados['nome'] . " </td>";
                        echo "<td>" . $dados['idcat'] . " </td>";
                        echo "<td> <img src=../img/rocha/" . $dados['img'] . " width='50px' height='auto'></td>";
                        echo "<td><a class='center waves-effect waves-light btn-small blue' href='editrocha.php?idrocha=" . $dados['idrocha'] . "&sugestao=0'>Editar</a>";
                        echo " <a class='center waves-effect waves-light btn-small green' href='editar.php?idrocha=" . $dados['idrocha'] . "&sugestao=0'>Aceitar</a>";
                        echo " <a id='btnExcluir-" . $dados['idrocha'] . "' class='center waves-effect waves-light btn-small red' data-idrocha='" . $dados['idrocha'] . "'>Excluir</a></td>";
                        echo '</tr>';
                    } ?>
                </table>
            </div>
        </div>
        <br><br><br>
    </main>

    <?php include "footer.php"; ?>

    <script src="../js/sweetalert.js"></script>
    <script>
        document.querySelectorAll('[id^="btnExcluir-"]').forEach(button => {
            button.addEventListener('click', function() {
                const idrocha = this.getAttribute('data-idrocha');
                Swal.fire({
                    title: "Tem certeza que deseja excluir a rocha?",
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