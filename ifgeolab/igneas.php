<?php session_start();
include "include.php"; ?>
<style>
    .minha-imagem {
        height: 220px;
        width: 600px;
        object-fit: cover;
    }

    .meu-span {
        background-color: rgba(0, 0, 0, 0.3);
        width: 100%;
    }
</style>

<body>
    <?php
    $breadcrumbs = [
        'Rochas' => '> <a href="rocha.php">Rochas</a>',
        'Ígneas' => '<a class="active" href="igneas.php">Ígneas</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="vertical-line"></div>
            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Rochas Ígneas</h4>
                    <hr class="divider">
                </div>
                <div class="row">
                    <?php
                    require_once 'conecta.php';
                    $sql = "SELECT * FROM rocha WHERE idcat=1 and sugestao=0";
                    $conexao = conectar();
                    $resultado = mysqli_query($conexao, $sql);
                    while ($dados = mysqli_fetch_array($resultado)) {
                        $nome = $dados['nome'];
                        $cat = $dados['idcat'];
                        $descricao = $dados['descricao'];
                        $img = $dados['img'];

                        ?>
                        <div class="col s12 l4 m8">
                            <div class="card hoverable">

                                <div class="card-image transparent">
                                    <img src="img/rochas/<?= $img; ?>" class="minha-imagem materialboxed ">
                                    <span
                                        class="card-title center meu-span green-text text-lighten-3"><?php echo $nome ?></span>
                                </div>
                                <div class="card-action green darken-4">
                                    <a class="green-text text-lighten-3"
                                        href="saibaRocha.php?idrocha=<?php echo $dados['idrocha'] ?>">Saiba mais</a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <br><br><br>
    </main>
    <?php
    include "footer.php";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const materialboxElems = document.querySelectorAll('.materialboxed');
            M.Materialbox.init(materialboxElems);
        });
    </script>