<?php session_start();
include "include.php"; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

    .swiper {
        width: 250px;
        height: auto;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
        margin-right: 5px;
    }

    .swiper-slide {
        width: 100%;
        height: auto;
        padding: 5px 0;
        margin-right: 0;
    }

    .swiper-slide img {
        display: block;
        width: 50%;
        height: 100%;
        object-fit: cover;
    }

    .swiper-wrapper {
        margin-right: 5px;
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
        <br><br>
        <?php if ($obj != "") { ?>
            <div class="container">
                <div class="row center">
                    <div class="wrapp">
                        <div class="card">
                            <div class="card__item">
                                <model-viewer class="card__model" style="background-color: rgb(255,255,255);"
                                    shadow-intensity="1" src="obj/<?= $obj; ?>" camera-orbit="45deg 55deg" autoplay
                                    auto-rotate ar camera-controls touch-action="pan-y"></model-viewer>
                                <span class="card__txt">
                                    <?= $nome; ?>
                                </span>
                            </div>
                        </div>
                        <a class="gerarpdf waves-effect waves-light accent-4"
                            href="relatorioMineral.php?idmineral=<?= $idrocha; ?>">
                            <img class="pdf" src="img/pdf-icon.png"> Gerar PDF</a>
                    </div>
                    <h5 class="center"><b>Categoria:</b>
                        <?= $cat; ?>
                    </h5>
                    <?php while ($img = mysqli_fetch_assoc($galeria)) {
                        if ($img != "") { ?>
                            <div thumbsSlider="" class="mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="img/rochas/<?= $img['imgR']; ?>"></div>
                                <?php }
                    } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container">
                <div class="row center">
                    <div class="wrapp">
                        <img src="img/rochas/<?= $imgR ?>" widht="auto" height="300px">
                    </div>
                    <a class="gerarpdf waves-effect waves-light accent-4"
                        href="relatorioRocha.php?idrocha=<?= $idrocha; ?>">
                        <img class="pdf" src="img/pdf-icon.png"> Gerar PDF</a>
                </div>
                <h5 class="center"><b>Categoria:</b>
                    <?= $cat; ?>
                </h5>
                <div thumbsSlider="" class="mySwiper">
                    <div class="swiper-wrapper">
                        <?php while ($img = mysqli_fetch_assoc($galeria)) {
                            if ($img != "") { ?>
                                <div class="swiper-slide"><img src="img/rochas/<?= $img['imgR']; ?>"></div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
    </script>
</body>

</html>