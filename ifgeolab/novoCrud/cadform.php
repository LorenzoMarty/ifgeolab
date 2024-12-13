<?php
session_start();
include "include.php";
include "quilljs.php";
include "CRUD.php";

$formtipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'mineral';

$breadcrumbs = [
  'Amostra' => '> <a href="Amostra.php">Amostras</a>',
  'Atual' => '<a class="active" href="#">' . ucfirst($formtipo) . '</a>'
];
$breadcrumb = implode('>', $breadcrumbs);

$idusuario = $_SESSION['id'];
navbar($breadcrumb);

$MineralRocha = new MineralRochaForm($formtipo, $idusuario);

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
        <?= $MineralRocha->render(); ?>
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