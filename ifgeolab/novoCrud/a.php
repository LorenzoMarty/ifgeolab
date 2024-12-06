<?php
session_start();

include "include.php";
include "CRUD.php";

$formTipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'mineral';

$breadcrumbs = [
    'Amostra' => '> <a href="amostra.php">Amostras</a>',
    ucfirst($formTipo) => '<a class="active" href="#">' . ucfirst($formTipo) . '</a>'
];
$breadcrumb = implode('>', $breadcrumbs);
navbar($breadcrumb);

include "quilljs.php";
$categoriasTabela = ($formTipo === 'rocha') ? 'catrocha' : 'catmineral';
?>

<style>
    .minha-imagem {
        height: 220px;
        width: 220px;
        object-fit: cover;
    }
</style>

<link rel="stylesheet" href="../css/image.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<body>
    <main>
        <div class="container">
            <div class="vertical-line"></div>
            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Editar <?= ucfirst($formTipo) ?></h4>
                    <hr class="divider">
                </div>
                <div class="row">
                    <form enctype="multipart/form-data" method="post" action="cadastrar.php" class="col s12 m6">
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="nome">Nome</label>
                                <input id="nome" name="nome" type="text" class="validate">
                            </div>

                            <?php if ($formTipo === 'mineral' || $formTipo === 'rocha'): ?>
                                <input type="hidden" name="idusuario" value="<?= $_SESSION['id'] ?>">
                                <div class="input-field col s6">
                                    <select class="select-dropdown" name="idcat">
                                        <?php
                                        $crud = new CRUD();
                                        $categorias = $crud->listar($categoriasTabela);
                                        foreach ($categorias as $categoria) {
                                            echo '<option value="' . htmlspecialchars($categoria['idcat']) . '">' . htmlspecialchars($categoria['nome']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php elseif ($formTipo === 'questao'): ?>
                                <div class="input-field col s12">
                                    <label for="pergunta">Pergunta</label>
                                    <textarea id="pergunta" name="pergunta" class="materialize-textarea"></textarea>
                                </div>
                                <div class="input-field col s6">
                                    <label for="opcao_a">Opção A</label>
                                    <input id="opcao_a" name="opcao_a" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <label for="opcao_b">Opção B</label>
                                    <input id="opcao_b" name="opcao_b" type="text" class="validate">
                                </div>
                            <?php elseif ($formTipo === 'usuario'): ?>
                                <div class="input-field col s6">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <label for="senha">Senha</label>
                                    <input id="senha" name="senha" type="password" class="validate">
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($formTipo === 'mineral' || $formTipo === 'rocha'): ?>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="hidden" id="descricao" name="descricao">
                                    <div id="editor-container"></div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($formTipo === 'mineral' || $formTipo === 'rocha'): ?>
                            <div class="row">
                                <div class="input-field col s6">
                                    <div class="img-area" data-img="">
                                        <i class='bx bxs-cloud-upload icon'></i>
                                        <h3>Envie uma Foto de Perfil</h3>
                                        <p>A Imagem não pode ser maior que <span>20MB</span></p>
                                        <input name="arquivo" type="file" id="Capa" style="display: none;">
                                    </div>
                                </div>
                                <div class="input-field col s6">
                                    <label>Objeto 3D:</label>
                                    <input name="3d" type="file" />
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="input-field col s12">
                            <button class="waves-effect waves-light btn green" type="submit"
                                name="editar<?= ucfirst($formTipo) ?>">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

<?php
include '../footer.php';
?>

<script src="../js/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.select-dropdown');
        M.FormSelect.init(elems);
    });
</script>