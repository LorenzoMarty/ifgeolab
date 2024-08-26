<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "../crud/include.php"; ?>
    <title>IF GeoLab</title>
</head>

<body>
    <?php
    $breadcrumbs = [
        'Amostra' => '> <a href="amostra.php">Amostras</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_SESSION['permissao'] == 2) {
            header("../index.php");
        }
    }
    ?>
    <main>
        <div class="container center">
            <h1>Cadastre Amostras</h1>
            
            <span>Cadastre sugestões de Rochas e Minerais</span>
            <br><br>
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
        </div>
    </main>
    <br><br><br><br>
    <?php
    include "footer.php";
    ?>
</body>

</html>