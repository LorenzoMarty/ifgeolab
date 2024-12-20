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
unset($_SESSION['questoes']);
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

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Laboratório</h4>
                    <h6 class="left-align">O que deseja acessar?</h6>
                    <hr class="divider">
                </div>

                <div class="menu">
                    <div class="row">
                        <div class="col s12 m4 l4 center-align">
                            <div class="card">
                                <div class="wrapper">
                                    <img src="img/rochas.png" alt="Rochas" class="cover-image">
                                    <img src="img/teste.png" alt="Teste" class="teste-image">
                                </div>
                                <div class="caption">Rochas</div>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 center-align">
                            <div class="card">
                                <div class="wrapper">
                                    <img src="img/mineral.png" alt="Minerais" class="cover-image">
                                    <img src="img/teste.png" alt="Teste" class="teste-image">
                                </div>
                                <div class="caption">Minerais</div>
                            </div>
                        </div>
                        <div class="col s12 m l4 center-align">
                            <div class="card">
                                <div class="wrapper">
                                    <img src="img/questionarios.png" alt="Questionários" class="cover-image">
                                    <img src="img/teste.png" alt="Teste" class="teste-image">
                                </div>
                                <div class="caption">Questionários</div>
                            </div>
                            <div class="card">
                                <?php if (isset($_SESSION['permissao'])) {
                                    if ($_SESSION['permissao'] == 1) {
                                        echo '<a href="crud-usuario/amostra.php">';
                                    } elseif ($_SESSION['permissao'] == 2) {
                                        echo '<a href="crud/sugestao.php">';
                                    }
                                }
                                ?>
                                <div class="wrapper">
                                    <img src="img/sugestoes.png" alt="Sugestões" class="cover-image">
                                    <img src="img/teste.png" alt="Teste" class="teste-image">
                                </div>
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