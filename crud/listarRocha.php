<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>If GeoLab</title>
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

    if (isset ($_COOKIE['acesso'])) {
        if ($_COOKIE['acesso']['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_COOKIE['acesso']['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        include "topo.php";
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
                $sql = "SELECT * FROM rocha";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql);
                while ($dados = mysqli_fetch_array($resultado)) {
                    $idrocha = $dados["idrocha"];
                    $nome = $dados['nome'];
                    $cat = $dados['cat'];
                    $descricao = $dados['descricao'];
                    $img = $dados['img'];

                    ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">

                            <div class="card-image">
                                <img src="../img/rochas/<?= $img; ?>" class="minha-imagem materialboxed ">
                                <span class="card-title center meu-span green-text text-lighten-3">
                                    <?php echo $nome ?>
                                </span>
                            </div>
                            <div class="card-action green darken-4">
                                <a class="center waves-effect waves-light btn green accent-4"
                                    href="../relatorio.php?idrocha=<?php echo $idrocha; ?>"><img
                                        src="../img/pdf-icon.png"></a>
                                <?php if (isset ($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 2) {
                                    echo "<a class='center waves-effect waves-light btn red' href='processaRocha.php?deletar=" . $idrocha . "'>Excluir</a> ";
                                    echo "<a class='center waves-effect waves-light btn green' href='editRocha.php?idrocha=" . $idrocha . "'>Editar</a>";
                                } ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <div class="col s12 l4 m8">
                        <div class="card hoverable">

                            <div class="card-image">
                                <img src="../img/rochas/rocha.png" class="minha-imagem materialboxed ">
                                <span class="card-title center meu-span green-text text-lighten-3">
                                    Novas Rochas
                                </span>
                            </div>
                            <div class="card-action green darken-4">
                                <a class="center waves-effect waves-light btn green accent-4" href="cadRocha.php">Cadastrar </a>
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
</body>

</html>