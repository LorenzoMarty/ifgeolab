<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_SESSION['id'];
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
  $dados = mysqli_fetch_assoc($resultado);
  $img = $dados['img'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <script src="../js/dark-light.js"></script>
  <title>IF GeoLab</title>
  <style>
    .minha-imagem {
      height: 220px;
      width: 220px;
      object-fit: cover;
    }

    .nav_color {
      background-color: #03300b;
    }

    .tabs .tab a {
      color: #fff;
      border-right: solid 1px grey;
    }

    #fot {

      background: linear-gradient(45deg, #212121 24%, rgba(255, 255, 255, 1) 24%);
    }

    .tabs .tab a:hover {
      background-color: #eee;
      color: black;
    }

    .tabs .tab a.active {
      color: #000;
    }

    .tabs .indicator {
      background-color: #000;
    }

    .icon {
      height: 32px;
      width: 32px;
      align-items: center;
      position: absolute;
    }

    footer {

      padding: 20px;
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

  if (isset($_SESSION['permissao'])) {
    if ($_SESSION['permissao'] == 1) {
      include "topo-user.php";
    } elseif ($_SESSION['permissao'] == 2) {
      include "topo-adm.php";
    }
  } else {
    header('Location: ../index.php');
  }
  ?>
  <div class="container">
    <h1> Editar Perfil </h1>
    <hr>
    <div class="row">
      <form action="editar.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="idusuario" value="<?= $_SESSION['id'] ?>">
        <div class="input-field col s12">
          <label> Nome </label><br>
          <input type="text" name="nome" required value="<?php echo $dados['nome']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Email </label><br>
          <input type="text" name="email" required value="<?php echo $dados['email']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Senha </label><br>
          <input type="password" name="senha" required value="<?php echo $_SESSION['senha']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Telefone </label><br>
          <input type="text" name="tel" required value="<?php echo $dados['telefone']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Matrícula: </label><br>
          <input type="text" name="matricula" required value="<?php echo $dados['matricula']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Instituição: </label><br>
          <input type="text" name="inst" required value="<?php echo $dados['instituto']; ?>" />
        </div>

        <div class="input-field col s12">
          <div class="row">
            <div class="col s3">
              <label> Insira uma foto de perfil:</label><br><br>
              <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed "><h6>Foto atual</h6></img><br><br>
              <input type="hidden" name="img" value="<?php echo $dados['img'] ?>">
              <input class="form-control" type="file" name="arquivo" />
            </div>
          </div>
        </div>

        <div class="input-field col s12">
          <button class="btn btn-primary green" type="submit" name="editarUsuario"> Editar </button>
        </div>

      </form>
    </div>


  </div>
  <?php
  include "footer.php";
  ?>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function() {
    $('.materialboxed').materialbox();
  });
</script>

</html>