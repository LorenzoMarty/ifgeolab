<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="../materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script src="../js/dark-light.js"></script>
    <title>IF GeoLab</title>
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
            <h1>Cadastro</h1>
            <hr>
            <span><b>Cadastre Rochas ou Minerais</b></span>
            <hr>
            <div class="row">
                <div class="col s6">
                    <a href="listarRocha.php" class="white-text">
                        <div class="card green">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../img/amosRochas.png">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s6">
                    <a href="listarMineral.php" class="white-text">
                        <div class="card green">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../img/amosMinerais.png">
                                </div>
                            </div>
                        </div>
                </div>
                </a>
            </div>

            <hr>
        </div>
    </main>
    <br><br><br><br>
    <?php
    include "footer.php";
    ?>
</body>

</html>