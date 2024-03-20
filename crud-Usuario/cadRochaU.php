<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js">
  <link rel="stylesheet" href="../dist/ui/trumbowyg.min.css">
  <link rel="stylesheet" href="../dist/plugins/upload/trumbowyg.upload.min.js">
  <link rel="stylesheet" href="../dist/plugins/emoji/trumbowyg.emoji.min.js">
  <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
  <title>Cadastrar Rocha</title>
  <style>
    nav.nav-center ul {
      text-align: center;
    }

    .li a:hover {
      background-color: #eee;
      color: black;
    }

    .li a.active {
      color: #000;
    }

    .li a {
      color: #fff;
      border-right: solid 1px grey;
    }

    nav.nav-center ul li {
      display: inline;
      float: none;
    }

    nav.nav-center ul li a {
      display: inline-block;
    }

    #fot {
      background: linear-gradient(45deg, #212121 24%, rgba(255, 255, 255, 1) 24%);
    }

    footer {
      padding: 30px;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>

<body>
  <?php
  require_once '../conecta.php';
  $conexao = conectar();

  if (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 1) {
    include "topo-user.php";
  } elseif (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 2) {
    include "topo-adm.php";
  } else {
    include "topo.php";
  }
  ?>
  <div class="container">
    <h4>Cadastrar Rocha</h4>
    <hr>
    <form enctype="multipart/form-data" method="post" action="sugerirRocha.php" class="col  s12 m6">

      <div class="row">
        <div class="input-field col s6">
          <input id="nome" name="nome" type="text" class="validate">
          <label for="nome">Nome</label>
        </div>
        
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
          <textarea id="trumbowyg-editor" name="desc" class="materialize-textarea"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="input-field">
          <label>Imagem:</label><br><br>
          <input type="file" name="arquivo" /> <br>
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
  </script>
  <script src="../dist/trumbowyg.min.js"></script>
  <script src="../dist/plugins/upload/trumbowyg.upload.min.js"></script>

  <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
  <!-- Import Trumbowyg plugins... -->
  <script src="../dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
  <script src="../dist/plugins/insertaudio/trumbowyg.insertaudio.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);
    });
  </script>

  <script>
    $('#trumbowyg-editor').trumbowyg({
      btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['upload'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
      ],
      plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
          serverPath: '../dicas-curiosidades-matematicas/upload.php',
          fileFieldName: 'image',
          headers: {
            'Authorization': 'Client-ID xxxxxxxxxxxx'
          },
          urlPropertyName: 'file'
        }
      },
      autogrow: true

    });
  </script>
  
</body>

</html>