<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>If GeoLab</title>
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

        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="left">Minerais</h3><br>
                </div>

                <div class="col s12">
                    <hr>
                    <p>Mineral é um corpo natural sólido e cristalino formado em resultado da interação de processos
                        físico-químicos em ambientes geológicos. Cada mineral é classificado e denominado não apenas com
                        base na sua composição química, mas também na estrutura cristalina dos materiais que o compõem.
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM sugerirmineral";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql); ?>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th scope="col">Id Mineral</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Id Categoria</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <?php while ($dados = mysqli_fetch_array($resultado)) {
                        $idmineral = $dados["idmineral"];
                        $nome = $dados['nome'];
                        $cat = $dados['idcat'];
                        $descricao = $dados['descricao'];
                        $img = $dados['img'];
                        
                        echo "<td> " . $dados['idmineral'] . " </td>";
                        echo "<td>" . $dados['nome'] . " </td>";
                        echo "<td>" . $dados['idcat'] . " </td>";
                        echo "<td> <img src=../img/mineral/" . $dados['img'] . " width='50px' height='auto'></td>";
                        echo "<td><a href='editMineralS.php?idmineral=" . $dados['idmineral'] . "'>" . "Editar" . "</a>";
                        echo " <a href='processaMineral.php?deletar=" . $dados['idmineral'] . "'>" . "Excluir" . "</a></td>";
                        echo '</tr>';
                    } ?>
                    </table>
            </div>
        </div>
            <br><br><br>
    </main>

    <?php
    include "footer.php";
    ?>
</body>

</html>