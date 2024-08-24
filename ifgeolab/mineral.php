<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include.php"; ?>
    <title>IF GeoLab</title>
    <style>
        .column {
            text-align: center;
            position: relative;
            margin-top: 20px;
        }

        .column:hover .image {
            transform: translateY(-100px);
        }

        .image{
            top: 50%;
            left: 20%;
        }
        h2.dark,h2.light {
            font-size: 2.56rem;
            line-height: 110%;
            margin: 2.3733333333rem 0 1.424rem 0;
            position: relative;
            z-index: 2;
            margin-bottom: 10px;
        }
        h2.light {
            color: #111111de;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7);
        }

        h2.dark {
            color: #e0e0e0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <?php
    $breadcrumbs = [
        'Minerais' => '> <a href="mineral.php">Minerais</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
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
        <div class="container center">
            <div class="row col s12">
                <h3 class="center">Tipos de minerais</h3><br>
            </div>
            <hr>
            <p>Mineral é um corpo natural sólido e cristalino formado em resultado da interação de processos
                físico-químicos em ambientes geológicos. Cada mineral é classificado e denominado não apenas com
                base na sua composição química, mas também na estrutura cristalina dos materiais que o compõem. </p>
            <hr>
            <div class="row">
                <div class="col s12 m6">
                    <div class="column">
                        <a href="metalica.php" class="white-text">
                            <img src="img/mineral2.png" alt="Minerais Metálicos" class="image">
                            <h2>METÁLICOS</h2>
                        </a>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="column">
                        <a href="n-metalica.php" class="white-text">
                            <img src="img/n-mineral2.png" alt="Minerais Metálicos" class="image">
                            <h2>NÃO-METÁLICOS</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>