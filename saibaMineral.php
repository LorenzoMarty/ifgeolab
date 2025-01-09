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
    $idmineral = $_GET['idmineral'];

    $sql = "SELECT * FROM mineral WHERE idmineral =" . $idmineral;
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        $imgM = $dados['img'];
        $catJ = $dados['idcat'];
        $idrock = $dados['idmineral'];
        $obj = $dados['3d'];
        $nome = $dados['nome'];
        $descricao = $dados['descricao'];
    }

    $catm = "SELECT * FROM catmineral WHERE idcat='$catJ'";
    $res = mysqli_query($conexao, $catm);
    while ($d = mysqli_fetch_assoc($res)) {
        $idcat = $d['idcat'];
        $name = $d['nome'];
    }
    if ($dados['idcat'] == $idcat) {
        $cat = $name;
    } else {
        echo "Erro ao buscar a categoria no banco de dados!";
    }
    $galeriaMineral = "SELECT * FROM img_mineral WHERE idmineral=" . $idmineral;
    $galeria = mysqli_query($conexao, $galeriaMineral);

    $breadcrumbs = [
        'Minerais' => '> <a href="mineral.php">Minerais</a>',
    ];

    if ($idcat == "1") {
        $breadcrumbs['Metálicos'] = '<a class="active" href="metalica.php">Metálicos</a>';
    } else {
        $breadcrumbs['Não-Metálicos'] = '<a class="active" href="n-metalica.php">Não-Metálicos</a>';
    }

    $breadcrumb = implode(' > ', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <?php if ($obj != "") { ?>
            <div class="container">
                <div class="row center">
                    <div class="wrapp">
                        <div class="col s12">
                            <div class="card">
                                <model-viewer id="model-viewer" class="card__model" shadow-intensity="1" src="obj/<?= $obj; ?>"
                                    max-camera-orbit="auto 90deg" autoplay auto-rotate ar ar-modes="scene-viewer quick-look" camera-controls
                                    touch-action="pan-y"
                                    poster="img/geolab-branco.png">
                                </model-viewer>
                                <span class="card-title">
                                    <?= $nome; ?>
                                </span>
                            </div>
                            <a class="right gerarpdf waves-effect waves-light accent-4"
                                href="relatorioMineral.php?idmineral=<?= $idmineral; ?>">
                                <img class="pdf" src="img/pdf-icon.png"> Gerar PDF</a>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="center"><b>Categoria:</b>
                <?= $cat; ?>
            </h5>
        <?php } else { ?>
            <div class="container">
                <div class="row center">
                    <div class="wrapp">
                        <img src="img/mineral/<?= $imgM ?>" widht="auto" height="300px">
                    </div>
                    <a class="gerarpdf waves-effect waves-light accent-4"
                        href="relatorioMineral.php?idmineral=<?= $idmineral; ?>">
                        <img class="pdf" src="img/pdf-icon.png"> Gerar PDF</a>
                </div>
                <h5 class="center"><b>Categoria:</b>
                    <?= $cat; ?>
                </h5>
                <div thumbsSlider="" class="mySwiper">
                    <div class="swiper-wrapper">
                        <?php while ($img = mysqli_fetch_assoc($galeria)) { ?>
                            <div class="swiper-slide"><img src="img/mineral/<?= $img['imgM']; ?>"></div>
                        <?php } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const materialboxElems = document.querySelectorAll('.materialboxed');
            M.Materialbox.init(materialboxElems);
        });

        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
    </script>
</body>

</html>