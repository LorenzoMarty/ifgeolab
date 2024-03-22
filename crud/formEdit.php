<?php
session_start();
include_once('../conecta.php');
$conexao = conectar();
$idusuario = $_COOKIE['acesso']['id'];

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_COOKIE['acesso']['id'];
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
  <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <title>If GeoLab</title>
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
  if (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 1) {
    include "topo-user.php";
  } elseif (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 2) {
    include "topo-adm.php";
  } else {
    include "topo.php";
  }
  ?>
  <div class="container">
    <h1> Editar Perfil </h1>
    <hr>
    <div class="row">
      <form action="processaUsuario.php?idusuario =<?php echo $_COOKIE['acesso']['id']; ?>" method="POST" enctype="multipart/form-data">

        <div class="input-field col s12">
          <label> Nome </label><br>
          <input type="text" name="nome" required="required" value="<?php echo $dados['nome']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Email </label><br>
          <input type="text" name="email" required="required" value="<?php echo $dados['email']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> senha </label><br>
          <input type="password" name="senha" required="required" value="<?php echo $_COOKIE['acesso']['senha']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Telefone </label><br>
          <input type="text" name="tel" required="required" value="<?php echo $dados['telefone']; ?>" />
        </div>
        <div class="input-field col s12">
          <label> Matrícula: </label><br>
          <input type="text" name="matricula" required="required" value="<?php echo $dados['matricula']; ?>" />
        </div>

        <div class="input-field col s12">
          <div class="row">
            <label> Insira uma foto de perfil:</label><br><br>
            <div class="col s3">
              <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed ">Foto atual</img>
            </div>
            <div class="col s9">
              <input class="form-control" type="file" name="arquivo" />
            </div>
          </div>
        </div>

        <div class="input-field col s12">
          <button class="btn btn-primary green" type="submit" name="editar" value="<?php echo $dados['img'] ?>"> Editar </button>
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