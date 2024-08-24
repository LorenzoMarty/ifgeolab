<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "include.php"; ?>
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
            header('Location: ../index.php');
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        header('Location: ../index.php');
    }
    ?>
    <main>
        <div class="container center">
            <h1>Amostras</h1>

            <span>Veja amostras cadastradas de Rochas ou Minerais</span>
            <br><br>
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