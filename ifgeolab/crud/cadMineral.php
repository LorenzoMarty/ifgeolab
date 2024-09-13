<?php session_start();
include "include.php";
include "quilljs.php"; ?>
<link rel="stylesheet" href="../css/image.css">

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
  navbar($breadcrumb);

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
        <div class="input-field col s6">
          <label>Objeto 3D:</label>
          <input type="file" name="3d" />
        </div>
      </div>
      <div class="row">
        <div class="MultiFile-wrap input-field col">
          <label>Imagem Carrossel:</label><br><br>
          <input type="file" multiple="multiple" class="multi with-preview" name="multifile-test[]" id="upload_files">
          <ul id="F9-Log" class="row"></ul>
        </div>
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
  <script src="../js/uploadmulti.js"></script>
  <script src="../js/quill.js"></script>
  <script src="../js/image.js"></script>
</body>

</html>