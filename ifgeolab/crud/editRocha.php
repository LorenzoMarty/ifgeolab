<?php session_start();
include "include.php";
include "quilljs.php";

$breadcrumbs = [
    'Amostra' => '> <a href="amostra.php">Amostras</a>',
    'Rochas' => '<a href="listarRocha.php">Rochas</a>'
];
$breadcrumb = implode('>', $breadcrumbs);

navbar($breadcrumb);

require_once '../conecta.php';
$conexao = conectar();

if (isset($_GET['idrocha'])) {
    $id = $_GET['idrocha'];
    $sql = "SELECT * FROM rocha WHERE idrocha=$id";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);
    $descricao = $dados['descricao'];
    $nome = $dados['nome'];
    $idCat = $dados['idcat'];
    if ($dados['sugestao'] == "0") {
        $suges = $dados['sugestao'];
    } else {
        $suges = $_GET['sugestao'];
    }
}
?>
<style>
    .minha-imagem {
        height: 220px;
        width: 220px;
        object-fit: cover;
    }
</style>


<body>
    <div class="container">
        <h4>Editar Rocha</h4>
        <hr>
        <form enctype="multipart/form-data" method="post" action="editar.php" class="col  s12 m6">

            <div class="row">
                <div class="input-field col s6">
                    <input id="nome" name="nome" type="text" value="<?= $nome; ?>" class="validate">
                    <input type="hidden" name="idrocha" value="<?= $id; ?>">
                    <input type="hidden" name="sugestao" value="<?= $suges; ?>">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s6">
                    <select name="idcat" class="select-dropdown">
                        <?php
                        require_once "../conecta.php";
                        $conexao = conectar();
                        $y = "SELECT * FROM catrocha";
                        $res = mysqli_query($conexao, $y);
                        while ($dad = mysqli_fetch_assoc($res)) {
                        ?>
                            <option value="<?= $dad['idcat']; ?>">
                                <?= $dad['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="descricao"> Descrição</label>
                    <div id="editor-container">
                        <?= $dados['descricao'] ?>
                    </div>
                    <input type="hidden" id="descricao" name="descricao">
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label>Imagem:</label><br><br>
                    <div class="col s3">
                        <img src="../img/rochas/<?= $dados['img']; ?>" class="minha-imagem materialboxed ">Foto
                        atual</img>
                        <input type="file" name="arquivo" value="<?= $dados['img']; ?>" /> <br>
                    </div>
                </div>
                <div class="input-field col s12">
                    <button class="waves-effect waves-light btn green" type="submit" name="editarRocha">Editar</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.select-dropdown');
            var instances = M.FormSelect.init(elems);
        });
    </script>
    <script src="../js/quill.js"></script>
</body>

</html>