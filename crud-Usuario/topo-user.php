<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/materialize.css">
</head>
<style>
  .sticky-nav {
    position: -webkit-sticky;
    /* Safari */
    position: sticky;
    top: 0;
    z-index: 1;
  }
</style>
<?php

require_once('../conecta.php');
$conexao = conectar();
$idusuario = $_SESSION['id'];

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_SESSION['id'];
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
  $dados = mysqli_fetch_assoc($resultado);
  $img = $dados['img'];
}



?>

<body>

  <header>

    <div class="row">
      <div class="col s12 center-align" style="margin-top: 0.2%;">
        <a href="../index.php">
          <img class="responsive-img" src="../img/geolab-branco.png" alt="Logo do site" height="200" width="200">
        </a>
      </div>
    </div>

    <div class="container">
    </div>
    </div>
    <nav class="nav_color">
      <div class="nav-wrapper">
        <a href="#" data-target="telefone-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
          <li><a class="white-text" href="../index.php">Início</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
        <li><a class="white-text" href="../crud-usuario/Amostra.php">Amostra</a></li>
        <li style="margin-right: 10px;"><a href="../crud/editUser.php?idusuario=" .<?php $_SESSION['id']; ?>><?php echo $dados['nome']; ?></a></li>
          <li style="margin-right: 10px;"><img src="../img/usuarios/<?= $img; ?>" class="perfil materialboxed "></li>
        </ul>


      </div>
    </nav>
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
  <script>
    $(document).ready(function () {

      $(window).scroll(function () {

        if ($(window).scrollTop() > 150) {

          $('nav').addClass('sticky-nav');

        } else {

          $('nav').removeClass('sticky-nav');
        }

      });
    });
  </script>