<?php
session_start();
include "include.php";
include "quilljs.php";
include "CRUD.php";

$formtipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'mineral';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$breadcrumbs = [
  'Amostra' => '> <a href="Amostra.php">Amostras</a>',
  'Atual' => '<a class="active" href="#">' . ucfirst($formtipo) . '</a>'
];
$breadcrumb = implode('>', $breadcrumbs);

$idusuario = $_SESSION['id'] ?? null;
navbar($breadcrumb);

switch ($formtipo) {
  case "mineral":
  case "rocha":
    $form = new MineralRochaForm($formtipo, $id);
    break;
  case "usuario":
    $form = new UsuarioForm($formtipo, $id);
    break;
  case "questionario":
    $form = new QuestionarioForm($formtipo, $id);
    break;
  default:
    echo "<p>Tipo de formulário inválido.</p>";
    exit;
}
?>

<link rel="stylesheet" href="../css/image.css">

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
    document.addEventListener('DOMContentLoaded', function() {
      // Inicializa os dropdowns do Materialize
      var elems = document.querySelectorAll('.select-dropdown');
      var instances = M.FormSelect.init(elems);
    });
  </script>