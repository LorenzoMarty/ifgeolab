<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
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
            <h1>Amostras cadastradas</h1>
            <hr>
            <span>Valide amostras cadastradas por usuários</span>
            <hr>
            <div class="row">
                <div class="col s6">
                    <a href="listarRochaS.php" class="white-text">
                        <div class="card green">
                            <div class="card-image">
                                <img src="../img/rochas.png">
                            </div>
                        </div>
                    </a>
                </div>
                <a href="listarMineralS.php" class="white-text">
                    <div class="col s6">
                        <div class="card green">
                            <div class="card-image">
                                <img src="../img/minerais.png">
                            </div>
                        </div>
                    </div>
            </div>
            </a>

            <hr>
        </div>
    </main>
    <br><br><br><br>
    <?php
    include "footer.php";
    ?>
</body>

</html>