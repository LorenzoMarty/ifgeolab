<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>Listar Rochas</title>
    <style>
        .minha-imagem {
            height: 220px;
            width: 600px;
            object-fit: cover;
        }

        .meu-span {
            background-color: rgba(0, 0, 0, 0.3);
            width: 100%;
        }
    </style>
</head>

<body>
    <?php

    if (isset ($_COOKIE['acesso'])) {
        if ($_COOKIE['acesso']['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_COOKIE['acesso']['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        include "topo.php";
    }
    ?>
        <main>
        <div class="container">
        <div class="row col s12">
                <h3 class="left">Tipos de rochas</h3>
            </div>
            <hr>
            <p>Rocha é um agregado sólido que ocorre naturalmente e é constituído por um ou mais minerais ou
                mineraloides. A camada externa sólida da Terra, conhecida por litosfera, é constituída por rochas. </p>
            <hr>
            <div class="row">
                <div class="col s12 l4 m8">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img src="img/igneas.png" class="minha-imagem">
                        </div>
                        <div class="card-action green">
                            <a href="igneas.php" class="white-text"><h5>Ígneas</h5></a>
                        </div>
                    </div>
                </div>
                <div class="col s12 l4 m8">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img src="img/sedimentares.png" class="minha-imagem">
                        </div>
                        <div class="card-action green">
                            <a href="sed.php" class="white-text"><h5>Sedimentares</h5></a>
                        </div>
                    </div>
                </div>
                <div class="col s12 l4 m8">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img src="img/metamorficas.png" class="minha-imagem">
                        </div>
                        <div class="card-action green">
                            <a href="met.php" class="white-text"><h5>Metamórficas</h5></a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>