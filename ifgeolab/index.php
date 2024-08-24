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
unset($_SESSION['questoes'])
?>

<head>
    <?php

    include "include.php";
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
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IF GeoLab</title>
    </head>
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
            top: 50%;
            left: 20%;
        }

        .image1 {
            top: -50%;
            left: 20%;
        }

        .color {
            color: black;
        }
    </style>

<body>
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
            <br><br><br><br>
            <hr>
            <h2>Questionário</h2>
            <div class="questionario">
                <div class="col s12 m7">
                    <div class="column">
                        <div class="card">
                            <div class="card-image">
                                <img src="img/questionario.png" alt="Questionário">
                            </div>
                            <div class="card-content color">
                                <p>Questionário com questões de Enem sobre o conteúdo de Rochas e Minerais</p>
                            </div>
                            <div class="card-action">
                                <a href="questionario.php">Teste seus conhecimentos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>
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