<?php
session_start();
include "include.php";
include "quilljs.php";
include "CRUD1.php";

$formtipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'mineral';

$breadcrumbs = [
  'Amostra' => '> <a href="Amostra.php">Amostras</a>',
  'Atual' => '<a class="active" href="#">' . ucfirst($formtipo) . '</a>'
];
$breadcrumb = implode('>', $breadcrumbs);

$id = $_SESSION['id'];
navbar($breadcrumb);

$form = new Form("cadastrar.php", "POST", "multipart/form-data", "cad{$formtipo}", "col s12 m6");

$crud = new CRUD();
$categoriaTable = ($formtipo == 'rocha') ? 'catrocha' : 'catmineral';
$categorias = $crud->listar($categoriaTable);

$selectOptions = [];
foreach ($categorias as $dados) {
  $selectOptions[$dados['idcat']] = htmlspecialchars($dados['nome']);
}

// Linha 1: Nome e Categoria
$form->addRow([
  $form->addInput("text", "nome", "Nome", "", ["class" => "validate", "id" => "nome"], "s6"),
  $form->addInput("select", "cat", "Categoria", "", [
    "options" => $selectOptions,
    "class" => "select-dropdown",
    "id" => "cat"
  ], "s6")
]);

// Linha 2: Campo hidden para sugestão, id do usuário e Descrição (editor)
$form->addRow([
  $form->addInput("hidden", "sugestao", "", "0"),
  $form->addInput("hidden", "idusuario", "", $id),
  $form->addInput("hidden", "descricao", "", "", ["id" => "descricao"]),
  $form->addInput("custom", "", "", "", [
    "html" => '<div id="editor-container"></div>'
  ], "s12")
]);

// Linha 3: Foto de Perfil e Objeto 3D
$form->addRow([
  $form->addInput("custom", "", "", "", [
    "html" => '
        <div class="img-area" data-img="">
            <i class="bx bxs-cloud-upload icon"></i>
            <h3>Envie uma Foto de Perfil</h3>
            <p>A Imagem não pode ser maior que <span>20MB</span></p>
            <input name="arquivo" type="file" id="Capa" style="display: none;">
        </div>'
  ], "s6"),
  $form->addInput("file", "3d", "Objeto 3D:", "", ["id" => "3d"], "s6")
]);

// Linha 4: Imagem Carrossel (upload múltiplo)
$form->addRow([
  $form->addInput("custom", "", "Imagem Carrossel:", "", [
    "html" => '
        <div class="MultiFile-wrap input-field col s12">
            <label>Imagem Carrossel:</label><br><br>
            <input type="file" multiple="multiple" class="multi with-preview" name="multifile-test[]" id="upload_files">
            <ul id="F9-Log" class="row"></ul>
        </div>'
  ], "s12")
]);

// Linha 5: Botão de envio
$form->addRow([
  $form->addInput("submit", "cadastrar" . ucfirst($formtipo), "", "Cadastrar", [
    "class" => "waves-effect waves-light btn green"
  ], "s12")
]);

?>

<link rel="stylesheet" href="../css/image.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<body>
  <main>
    <div class="container">
      <div class="vertical-line"></div>
      <div class="section-content">
        <div class="section">
          <h4 class="left-align">Cadastrar <?= ucfirst($formtipo) ?></h4>
          <hr class="divider">
        </div>
        <?= $form->render(); ?>
      </div>
    </div>
  </main>

  <?php
  include '../footer.php';
  ?>

  <script src="../js/uploadmulti.js"></script>
  <script src="../js/quill.js"></script>
  <script src="../js/image.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.select-dropdown');
      var instances = M.FormSelect.init(elems);
    });
  </script>