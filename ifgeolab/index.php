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
navbar($breadcrumb);
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
                <div class="menu">
                    <div class="col s12 m6 l3 center-align">
                        <div class="image-container">
                            <a href="rocha.php">
                                <img src="img/rochas.png" alt="Rochas" class="image-with-caption grayscale hoverable responsive-img">
                                <div class="caption">Rochas</div>
                            </a>
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center-align">
                        <div class="image-container">
                            <a href="mineral.php">
                                <img src="img/mineral.png" alt="Minerais" class="image-with-caption grayscale hoverable responsive-img">
                                <div class="caption">Minerais</div>
                            </a>
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center-align">
                        <!-- Questionários e Sugestões na mesma coluna -->
                        <div class="image-container" style="margin-bottom: 0.75rem;">
                            <a href="questionario.php">
                                <img src="img/questionarios.png" alt="Questionários" class="image-with-caption responsive-img">
                                <div class="caption">Questionários</div>
                            </a>
                        </div>
                        <div class="image-container">
                            <?php if (isset($_SESSION['permissao'])) {
                                if ($_SESSION['permissao'] == 1) {
                                    echo '<a href="crud-usuario/amostra.php">';
                                } elseif ($_SESSION['permissao'] == 2) {
                                    echo '<a href="crud/sugestao.php">';
                                }
                            }
                            ?>
                            <img src="img/sugestoes.png" alt="Sugestões" class="image-with-caption responsive-img">
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
