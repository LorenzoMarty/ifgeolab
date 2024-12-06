<?php session_start();
include "include.php"; ?>

<body>
    <?php
    $breadcrumbs = [
        'Rochas' => '> <a class="active" href="rocha.php">Rochas</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Tipos de rochas</h4>
                    <h6 class="left-align">As rochas são constituídas por um ou mais minerais.<br>
                        As rochas são classificadas em três tipos baseados na sua formação:</h6>
                    <hr class="divider">
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="image-container">
                            <a href="igneas.php">
                                <img src="img/igneas.png" alt="Rochas ígneas" class="image-with-caption">
                                <div class="caption">ÍGNEAS</div>
                            </a>
                        </div>
                    </div>

                    <div class="col s4">
                        <div class="image-container">
                            <a href="sed.php">
                                <img src="img/sedimentares.png" alt="Rochas Sedimentares" class="image-with-caption">
                                <div class="caption">SEDIMENTARES</div>
                            </a>
                        </div>
                    </div>
                    <div class="col s4">
                        <div class="image-container">
                            <a href="met.php">
                                <img src="img/metamórficas.png" alt="Rochas Metamórficas" class="image-with-caption">
                                <div class="caption">METAMÓRFICAS</div>
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