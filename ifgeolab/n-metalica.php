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
        'Minerais' => '> <a href="mineral.php">Minerais</a>',
        'Não-Metálicos' => '<a class="active" href="n-metalica.php">Não-Metálicos</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="vertical-line"></div>
            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Minerais Não-Metálicos</h4>
                    <hr class="divider">
                </div>
                <div class="row">
                    <?php
                    require_once 'conecta.php';
                    $sql = "SELECT * FROM mineral WHERE idcat=2 and sugestao=0";
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

                                <div class="card-image">
                                    <img src="img/mineral/<?= $img; ?>" class="minha-imagem materialboxed ">
                                    <span
                                        class="card-title center meu-span green-text text-lighten-3"><?php echo $nome ?></span>
                                </div>
                                <div class="card-action green darken-4">
                                    <a class="green-text text-lighten-3"
                                        href="saibamineral.php?idmineral=<?php echo $dados['idmineral'] ?>">Saiba mais</a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
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