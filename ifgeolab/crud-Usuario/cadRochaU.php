<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../css/image.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <?php include "../crud/include.php";
  include "../crud/quilljs.php" ?>
  <title>IF GeoLab</title>
</head>

<body>
  <?php
  $breadcrumbs = [
    'Amostra' => '> <a href="Amostra.php">Amostras</a>',
    'Rocha' => '<a href="cadRochaU.php">Rochas</a>'
  ];
  $breadcrumb = implode('>', $breadcrumbs);

  if (isset($_SESSION['permissao'])) {
    if ($_SESSION['permissao'] == 1) {
      include "topo-user.php";
    } elseif ($_SESSION['permissao'] == 2) {
      header('Location: ../index.php');
    }
  } else {
    header('Location: ../index.php');
  }
  ?>
  <div class="container">
    <h4>Cadastrar Rocha</h4>
    <hr>
    <form enctype="multipart/form-data" method="post" action="../crud/processaRocha.php" class="col  s12 m6">

      <div class="row">
        <div class="input-field col s6">
          <input id="nome" name="nome" type="text" class="validate">
          <label for="nome">Nome</label>
        </div>
        <input type="hidden" name="sugestao" value="1">
        <div class="input-field col s6">
          <select name="cat" class="validate">
            <?php
            require_once "../conecta.php";
            $conexao = conectar();
            $sql = "SELECT * FROM catrocha";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_assoc($resultado)) {
            ?>
              <option value="<?php echo $dados['idcat']; ?>"><?php echo $dados['nome']; ?></option>
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
        <div class="input-field">
          <label>Imagem:</label><br><br>
          <input type="file" name="arquivo" required /> <br>
        </div>
        <div class="input-field col s12">
          <button class="waves-effect waves-light btn green" type="submit" name="cadastrar">Cadastrar</button>
        </div>
      </div>
    </form>
  </div>

  <?php
  include 'footer.php';
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelector('select');
      M.FormSelect.init(elems);
    });
  </script>
  <script src="../js/quill.js"></script>
  <script src="../js/galery.js"></script>
  <script src="../js/image.js"></script>

</body>

</html>