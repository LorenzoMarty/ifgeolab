<?php session_start();
include "../crud/include.php"; ?>

<body>
    <?php
    $breadcrumbs = [
        'Amostra' => '> <a href="amostra.php">Amostras</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            include "topo-user.php";
        } elseif ($_SESSION['permissao'] == 2) {
            header("../index.php");
        }
    }
    ?>
    <link rel="stylesheet" href="../css/index.css">
    <main>
        <div class="container center">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Amostras</h4>
                    <h6 class="left-align">Cadastre sugestões de Rochas e Minerais</h6>
                    <hr class="divider">
                </div>
                <div class="row">
                    <div class="col center-align">
                        <div class="image-container">
                            <a href="cadRochaU.php">
                                <img src="../img/rochas.png" alt="Rochas" class="image-with-caption grayscale">
                                <div class="caption">Rochas</div>
                            </a>
                        </div>
                    </div>
                    <div class="col center-align">
                        <div class="image-container">
                            <a href="cadMineralU.php">
                                <img src="../img/mineral.png" alt="Mineral" class="image-with-caption grayscale">
                                <div class="caption">Minerais</div>
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