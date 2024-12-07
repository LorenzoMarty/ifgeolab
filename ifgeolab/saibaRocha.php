<?php session_start();
include "include.php"; ?>
<style>
    .minha-imagem {
        height: 400px;
        width: 400px;
        object-fit: cover;
        align-items: center;
    }

    .meu-span {
        background-color: rgba(0, 0, 0, 0.6);
        width: 100%;
    }

    .icon {
        height: 32px;
        width: 32px;
        align-items: center;
        position: absolute;
    }
</style>
<link rel="stylesheet" href="css/3d.css">

<body>
    <?php
    require_once('conecta.php');
    $conexao = conectar();
    $idrocha = $_GET['idrocha'];

    $sql = "SELECT * FROM rocha WHERE idrocha =" . $idrocha;
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        $imgR = $dados['img'];
        $catJ = $dados['idcat'];
        $idrock = $dados['idrocha'];
        $obj = $dados['3d'];
        $nome = $dados['nome'];
        $descricao = $dados['descricao'];
    }

    $j = "SELECT * FROM catrocha WHERE idcat='$catJ'";
    $res = mysqli_query($conexao, $j);
    while ($d = mysqli_fetch_assoc($res)) {
        $idcat = $d['idcat'];
        $name = $d['nome'];
    }
    if ($dados['idcat'] == $idcat) {
        $cat = $name;
    } else {
        echo "Erro ao buscar a categoria no banco de dados!";
    }
    $galeriaRochas = "SELECT * FROM img_rocha WHERE idrocha=" . $idrocha;
    $galeria = mysqli_query($conexao, $galeriaRochas);

    $breadcrumbs = [
        'Rochas' => '> <a href="rocha.php">Rochas</a>',
    ];
    if ($idcat == "1") {
        $breadcrumbs['Ígneas'] = '<a class="active" href="igneas.php">Ígneas</a>';
    } elseif ($idcat == "2") {
        $breadcrumbs['Metamórficas'] = '<a class="active" href="met.php">Metamórficas</a>';
    } elseif ($idcat == "3") {
        $breadcrumbs['Sedimentares'] = '<a class="active" href="sed.php">Sedimentares</a>';
    }
    $breadcrumb = implode(' > ', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="row center">
                <div class="wrapp">
                    <div class="col s12">
                        <div class="card">
                            <model-viewer id="model-viewer" class="card__model" shadow-intensity="2"
                                src="obj/<?= $obj; ?>" max-camera-orbit="auto 90deg" autoplay auto-rotate ar
                                ar-scale="fixed" camera-controls touch-action="pan-y" skybox-image="img/fundo.hdr"
                                poster="img/geolab-branco.png">
                            </model-viewer>
                            <span class="card-title"><?= $nome; ?></span>
                            <a class="gerarpdf waves-effect waves-light accent-4"
                                href="relatorioMineral.php?idmineral=<?= $idrocha; ?>">
                                Gerar PDF <img class="pdf" src="img/pdf-icon.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="center"><b>Categoria:</b>
            <?= $cat; ?>
        </h5>
        </div>
        <hr>
        <div class="container">
            <div class="col s12 m6 l4">
                <h5>
                    <?= $descricao; ?>
                </h5>
            </div>
            <hr>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>