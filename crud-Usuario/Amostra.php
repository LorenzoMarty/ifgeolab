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

    if (isset($_SESSION['acesso'])) {
        if ($_SESSION['acesso']['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_SESSION['acesso']['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        include "topo.php";
    }
    ?>
    <main>
        <div class="container">
            <h1>Cadastre Amostras</h1>
            <hr>
            <span>Cadastre sugestões de Rochas e Minerais</span>
            <hr>
            <div class="row">
                <div class="col s6">
                    <a href="cadRochaU.php" class="white-text">
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
                    <a href="cadMineralU.php" class="white-text">
                        <div class="card green">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../img/amosMinerais.png">
                                </div>
                            </div>
                        </div>
                    </a>
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