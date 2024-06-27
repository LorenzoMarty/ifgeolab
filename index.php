<?php session_start();
$msg = "";
if (isset($_SESSION['confirm'])) {
    $msg = $_SESSION['confirm'];
    unset($_SESSION['confirm']);
}
$login = "";
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    unset($_SESSION['login']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/dark-light.js"></script>
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
        .column:hover .image1 {
            transform: translateY(-100px);
        }

        .image {
            width: 250px;
            transition: transform 0.3s;
            position: absolute;
            top: 50%;
            left: 20%;
            transform: translateY(-60px);
            z-index: 1;
            opacity: 0.8;
            /* Optional: Add some opacity to the image */
        }
        .image1 {
            width: 250px;
            transition: transform 0.3s;
            position: absolute;
            top: -50%;
            left: 20%;
            transform: translateY(-60px);
            z-index: 1;
            opacity: 0.8;
            /* Optional: Add some opacity to the image */
        }
        .row {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php

$breadcrumb = "";
    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
        } else {
            include "topo.php";
        }
    } else {
        include "topo.php";
    }
    ?>
    <main>
        <div class="container center">
            <h1>Laboratório</h1>
            
            <h5>O que você deseja conhecer?</h5>

            <div class="row">
                <div class="col s12 m6">
                    <div class="column">
                        <a href="rocha.php">
                            <img src="img/rochas1.png" alt="Rochas" class="image">
                            <h2>Rochas</h2>
                        </a>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="column">
                        <a href="mineral.php">
                            <img src="img/mineral1.png" alt="Minerais" class="image1">
                            <h2>Minerais</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script src="js/sweetalert.js"></script>
    <script>
        <?php if ($msg != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($msg) ?>
                )
            })
        <?php } ?>

        <?php if ($login != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($login) ?>
                )
            })
        <?php } ?>
    </script>
</body>

</html>