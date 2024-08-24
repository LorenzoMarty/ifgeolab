<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
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
        'Rochas' => '> <a href="rocha.php">Rochas</a>'
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
                <h3>Tipos de rochas</h3>
            </div>
            <hr>
            <p>Rocha é um agregado sólido que ocorre naturalmente e é constituído por um ou mais minerais ou
                mineraloides. A camada externa sólida da Terra, conhecida por litosfera, é constituída por rochas. </p>
            <hr>
            <div class="row">
                <div class="col s12 l4 m8">
                    <div class="column">
                        <a href="igneas.php" class="white-text">
                            <img src="img/igneas1.png" alt="Rochas Ígneas" class="image">
                            <h2>ÍGNEAS</h2>
                        </a>
                    </div>
                </div>
                <div class="col s12 l4 m8">
                    <div class="column">
                        <a href="sed.php" class="white-text">
                            <img src="img/sedimentares1.png" alt="Rochas Sedimentares" class="image">
                            <h2>SEDIMENTARES</h2>
                        </a>
                    </div>
                </div>
                <div class="col s12 l4 m8">
                    <div class="column">
                        <a href="met.php" class="white-text">
                            <img src="img/metamorficas1.png" alt="Rochas Metamórficas" class="image">
                            <h2>METAMÓRFICAS</h2>
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