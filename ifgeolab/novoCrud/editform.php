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

$form = new Form("cadastrar.php", "POST");

if ($formTipo === 'mineral' || $formTipo === 'rocha') {
    $form->addInput("hidden", "idusuario", "", $_SESSION['id']);
    $form->addInput("text", "nome", "Nome:", "", ["class" => "validate"]);

    $crud = new CRUD();
    $categorias = $crud->listar($categoriasTabela);
    $selectOptions = [];
    foreach ($categorias as $categoria) {
        $selectOptions[$categoria['idcat']] = htmlspecialchars($categoria['nome']);
    }
    $form->addInput("select", "idcat", "Categoria:", "", ["options" => $selectOptions]);

    $form->addInput("hidden", "descricao", "", "", ["id" => "descricao"]);
    $form->addInput("custom", "", "", "", [
        "html" => '<div id="editor-container"></div>'
    ]);

    $form->addInput("file", "arquivo", "Foto de Perfil:", "", ["id" => "Capa"]);
    $form->addInput("file", "3d", "Objeto 3D:");
} elseif ($formTipo === 'questao') {
    $form->addInput("textarea", "pergunta", "Pergunta:", "", ["class" => "materialize-textarea"]);
    $form->addInput("text", "opcao_a", "Opção A:", "", ["class" => "validate"]);
    $form->addInput("text", "opcao_b", "Opção B:", "", ["class" => "validate"]);
} elseif ($formTipo === 'usuario') {
    $form->addInput("email", "email", "Email:", "", ["class" => "validate"]);
    $form->addInput("password", "senha", "Senha:", "", ["class" => "validate"]);
}

$form->addInput("submit", "editar" . ucfirst($formTipo), "", "Salvar", ["class" => "waves-effect waves-light btn green"]);
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
                    <?= $form->render(); ?>
                </div>
            </div>
        </div>
    </main>
</body>

<?php include '../footer.php'; ?>

<script src="../js/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.select-dropdown');
        M.FormSelect.init(elems);
    });
</script>
