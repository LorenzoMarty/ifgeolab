<?php session_start();
include "include.php"; ?>

<body>
    <?php
    $breadcrumbs = [
        'Minerais' => '> <a class="active" href="mineral.php">Minerais</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Tipos de minerais</h4>
                    <h6 class="left-align">Minerais são partes de rochas, de formação natural.<br>
                        Os minerais são classificados em dois tipos baseados na sua formação:</h6>
                    <hr class="divider">
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="image-container">
                            <a href="metalica.php" class="white-text">
                                <img src="img/metalicas.png" alt="Minerais Metálicos" class="image-with-caption">
                                <div class="caption">METÁLICOS</div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col s4">
                        <div class="image-container">
                            <a href="n-metalica.php" class="white-text">
                                <img src="img/nao-metalicas.png" alt="Minerais Metálicos" class="image-with-caption">
                                <div class="caption">NÃO METÁLICOS</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>