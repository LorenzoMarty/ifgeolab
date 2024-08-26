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
    <link rel="stylesheet" href="css/index.css">
<body>
    <main>
        <div class="container">
            <!-- Linha vertical à esquerda -->
            <div class="vertical-line"></div>

            <!-- Conteúdo da seção -->
            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Laboratório</h4>
                    <h6 class="left-align">O que deseja acessar?</h6>
                    <hr class="divider">
                </div>

                <!-- Linha com Rochas, Minerais, Questionários e Sugestões -->
                <div class="row">
                    <div class="col center-align">
                        <div class="image-container">
                            <a href="rocha.php">
                                <img src="img/rochas.png" alt="Rochas" class="image-with-caption grayscale">
                                <div class="caption">Rochas</div>
                            </a>
                        </div>
                    </div>
                    <div class="col center-align">
                        <div class="image-container">
                            <a href="mineral.php">
                                <img src="img/mineral.png" alt="Minerais" class="image-with-caption grayscale">
                                <div class="caption">Minerais</div>
                            </a>
                        </div>
                    </div>
                    <div class="col center-align">
                        <!-- Questionários e Sugestões na mesma coluna -->
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div class="image-container" style="margin-bottom: 0.75rem;">
                                <a href="questionario.php">
                                    <img src="img/questionarios.png" alt="Questionários" class="image-with-caption">
                                    <div class="caption">Questionários</div>
                                </a>
                            </div>
                            <div class="image-container">
                                <?php if($_SESSION['permissao'] == 1){
                                echo '<a href="crud-usuario/amostra.php">';
                                }elseif($_SESSION['permissao'] == 2){
                                    echo '<a href="crud/sugestao.php">';
                                }
                                    ?>
                                    <img src="img/sugestoes.png" alt="Sugestões" class="image-with-caption">
                                    <div class="caption">Sugestões</div>
                                </a>
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