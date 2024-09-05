<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../css/image.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <?php include "include.php";
  include "quilljs.php"; ?>
  <title>IF GeoLab</title>
</head>

<body>
  <?php
  require_once '../conecta.php';
  $conexao = conectar();

  $breadcrumbs = [
    'Amostra' => '> <a href="Amostra.php">Amostras</a>',
    'Mineral' => '<a href="listarMineral.php">Minerais</a>'
  ];
  $breadcrumb = implode('>', $breadcrumbs);

  $id = $_SESSION['id'];

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
  <div class="container">

    <h4>Cadastrar Mineral</h4>
    <hr>
    <form id="cadMineral" enctype="multipart/form-data" method="post" action="cadastrar.php" class="col s12 m6">

      <div class="row">
        <div class="input-field col s6">
          <label for="nome">Nome</label>
          <input id="nome" name="nome" type="text" class="validate">
        </div>
        <input type="hidden" name="sugestao" value="0">
        <input type="hidden" name="idusuario" value="<?= $id ?>">
        <div class="input-field col s6">
          <select class="select-dropdown" name="cat">
            <?php
            require_once "../conecta.php";
            $sql = "SELECT * FROM catmineral";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_assoc($resultado)) {
            ?>
              <option value="<?= $dados['idcat']; ?>"><?= $dados['nome']; ?></option>

            <?php } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="descricao"> Descrição</label>
          <input type="hidden" id="descricao" name="descricao">
          <div id="editor-container"></div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <div class="img-area" data-img="">
            <i class='bx bxs-cloud-upload icon'></i>
            <h3>Envie uma Foto de Perfil</h3>
            <p>A Imagem não pode ser maior que <span>20MB</span></p>
            <input name="arquivo" type="file" id="Capa" style="display: none;">
          </div>
        </div>
        <div class="input-field col s6 carrossel-container">
          <label>Imagem Carrossel:</label><br><br>
          <input name="carrossel[]" type="file" id="carrossel" multiple>
          <ul id="fileList" class="file-list"></ul>
        </div>
      </div>
      <div class="input-field obj3d-container">
        <label>Objeto 3D:</label><br><br>
        <input type="file" name="3d" /> <br>
      </div>
      <div class="input-field col s12">
        <button class="waves-effect waves-light btn green" type="submit" name="cadastrarMineral">Cadastrar</button>
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
  <script src="../js/galery.js"></script>
  <script src="../js/image.js"></script>
</body>

</html>