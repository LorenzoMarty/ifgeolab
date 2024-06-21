<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
    <link href="../materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
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
        } elseif ($_SESSION['permissao'] != "1" and "2") {
            include "topo.php";
        }
    } else {
        include "topo.php";
    }
    ?>
    <main>

        <div class="container">
            <div class="row col s12">
                <h3 class="left">Rochas Metamórficas</h3>
            </div>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <?php
                require_once 'conecta.php';
                $sql = "SELECT * FROM rocha WHERE idcat=2 and sugestao=0";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql);
                while ($dados = mysqli_fetch_array($resultado)) {
                    $nome = $dados['nome'];
                    $cat = $dados['idcat'];
                    $descricao = $dados['descricao'];
                    $img = $dados['img'];

                ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">

                            <div class="card-image">
                                <img src="img/rochas/<?= $img; ?>" class="minha-imagem materialboxed ">
                                <span class="card-title center meu-span green-text text-lighten-3"><?php echo $nome     ?></span>
                            </div>
                            <div class="card-action green darken-4">
                                <a class="green-text text-lighten-3" href="saibaRocha.php?idrocha=<?php echo $dados['idrocha']  ?>">Saiba mais</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
        <br><br><br>
    </main>
    <?php
    include "footer.php";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.materialboxed');
            var instances = M.Materialbox.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function() {
            $('.materialboxed').materialbox();
        });
    </script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</body>

</html>