<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/dark-light.js"></script>
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>Listar Rochas</title>
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
                <h3 class="left">Tipos de rochas</h3>
            </div>
            <hr>
            <p>Rocha é um agregado sólido que ocorre naturalmente e é constituído por um ou mais minerais ou
                mineraloides. A camada externa sólida da Terra, conhecida por litosfera, é constituída por rochas. </p>
            <hr>
            <div class="row">
                <a href="igneas.php">
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-image">
                                <img src="img/igneas.png" class="minha-imagem">
                            </div>
                            <div class="card-action green">
                                <h5 class="white-text">ÍGNEAS</h5>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="sed.php" class="white-text">
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-image">
                                <img src="img/sedimentares.png" class="minha-imagem">
                            </div>
                            <div class="card-action green">
                                <h5>SEDIMENTARES</h5>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="met.php" class="white-text">
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-image">
                                <img src="img/metamorficas.png" class="minha-imagem">
                            </div>
                            <div class="card-action green">
                                <h5>METAMÓRFICAS</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <hr>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>