<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>If GeoLab</title>
</head>

<body>
<?php

if (isset($_COOKIE['acesso'])){
 if ($_COOKIE['acesso']['permissao'] == 2) {
    include "topo-adm.php";
    ?>
    <main>
        <div class="container">
            <h1>Tipo de amostra</h1>
            <hr>
            <span>Cadastrar Rochas e Minerais</span>
            <hr>
            <div class="row">
                <div class="col s6">
                    <div class="card small green">
                        <div class="card-image">
                            <img src="../img/rocha.png">
                        </div>
                        <div class="card-action green">
                            <a href="listarRocha.php" class="white-text"><h5>Rochas</h5></a>
                        </div>
                    </div>
                </div>
                <div class="col s6">
                    <div class="card small green">
                        <div class="card-image">
                            <img src="../img/mineral.png">
                        </div>
                        <div class="card-action green">
                            <a href="listarMineral.php" class="white-text"><h5>Minerais</h5></a>
                        </div>
                    </div>
                </div>
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
<?php }else{ header('Location: ../index.php');} }else{ header('Location: ../index.php');}?>