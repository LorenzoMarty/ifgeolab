<?php session_start();
include "include.php"; ?>

<body>
    <?php
    $breadcrumbs = [
        'Sugestao' => '> <a href="sugestao.php">Sugestões</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            header('Location: ../index.php');
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        header('Location: ../index.php');
    }
    ?>
    <main>
        <div class="container center">
            <h1>Sugestões</h1>

            <span>Sugestões de amostras cadastradas por usuários</span>
            <br><br>
            <div class="row">
                <div class="col s6">
                    <a href="listarRochaS.php" class="white-text">
                        <div class="card green">
                            <div class="card-image">
                                <img src="../img/rochas.png">
                            </div>
                        </div>
                    </a>
                </div>
                <a href="listarMineralS.php" class="white-text">
                    <div class="col s6">
                        <div class="card green">
                            <div class="card-image">
                                <img src="../img/minerais.png">
                            </div>
                        </div>
                    </div>
            </div>
            </a>


        </div>
    </main>
    <br><br><br><br>
    <?php
    include "footer.php";
    ?>
</body>

</html>