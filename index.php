<?php session_start();
$msg = "";
if (isset($_SESSION['confirm'])) {
    $msg = $_SESSION['confirm'];
    unset($_SESSION['confirm']);
}
$login = "";
if(isset($_SESSION['login'])){
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
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>IF GeoLab</title>
    <style>
        body{
            background-color: #212529;
        }
        .minha-imagem {
            height: 220px;
            width: 600px;
            object-fit: cover;
        }

        .meu-span {
            background-color: rgba(0, 0, 0, 0.3);
            width: 100%;
        }
        h1,span{
            color: white;
        }
        .card,.card-image img{
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
    } else {
        include "topo.php";
    }
}else{
    include "topo.php";
}
    ?>
        <main>
            <div class="container">
                <h1>Laboratório</h1>
                <hr>
                <span>Conheça Rochas e Minerais e seus tipos</span>
                <hr>
                <div class="row">
                    <div class="col s6">
                        <a href="rocha.php">
                            <div class="card green">
                                <div class="card hoverable">
                                    <div class="card-image">
                                        <img src="img/rocha.png">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col s6">
                        <a href="mineral.php">
                            <div class="card green">
                                <div class="card hoverable">
                                    <div class="card-image">
                                        <img src="img/mineral.png">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </main>
    <?php
    include "footer.php";
    ?>
</body>
<script src="js/sweetalert.js"></script>
<script>
    <?php if($msg != ""){ ?>
    window.addEventListener("load", (event) => {
        Swal.fire(
            <?= json_encode($msg) ?>
        )
    })
    <?php } ?>
    
    <?php if($login != ""){ ?>
        window.addEventListener("load", (event) => {
        Swal.fire(
            <?= json_encode($login) ?>
        )
    })
        <?php } ?>
</script>

</html>