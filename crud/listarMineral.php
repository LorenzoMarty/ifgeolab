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

        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="left">Minerais</h3><br>
                </div>

                <div class="col s12">
                    <hr>
                    <p>Mineral é um corpo natural sólido e cristalino formado em resultado da interação de processos
                        físico-químicos em ambientes geológicos. Cada mineral é classificado e denominado não apenas com
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
                $sql = "SELECT * FROM mineral";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql);
                while ($dados = mysqli_fetch_array($resultado)) {
                    $idmineral = $dados["idmineral"];
                    $nome = $dados['nome'];
                    $cat = $dados['idcat'];
                    $descricao = $dados['descricao'];
                    $img = $dados['img'];

                    ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">

                            <div class="card-image">
                                <img src="../img/mineral/<?= $img; ?>" class="minha-imagem materialboxed ">
                                <span class="card-title center meu-span white-text text-lighten-3">
                                    <?php echo $nome ?>
                                </span>
                            </div>
                            <div class="card-action green darken-4">
                            <a class="center waves-effect waves-light btn green accent-4" href="../relatorio.php?idmineral=<?php echo $idmineral; ?>"><img src="../img/pdf-icon.png"></a>
                            <?php if (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 2) {
                        echo "<a class='center waves-effect waves-light btn red' href='processaMineral.php?deletar=" . $idmineral . "'>Excluir</a> ";
                        echo "<a class='center waves-effect waves-light btn green' href='editMineral.php?idmineral=" . $idmineral . "'>Editar</a>";
                    } ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <div class="col s12 l4 m8">
                    <div class="card hoverable">
                        <div class="card-action center green darken-4">
                            <a class="center waves-effect waves-light btn green accent-4" href="cadMineral.php">Cadastrar</a>
                        </div>
                    </div>
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
</body>

</html>