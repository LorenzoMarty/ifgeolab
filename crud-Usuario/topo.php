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
    <nav class="nav_color" role="navigation">
      <div class="nav-wrapper">
        <a href="#" data-target="telefone-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
          <li><a class="white-text" href="../index.php">Início</a></li>
        </ul>
        <ul class="right hide-on-med-and-down" style="margin-right: 20px;">
          <li><a class="white-text" href="../login.php">Login</a></li>
          <li><a class="white-text" href="../crud/cadUsuario.php">Cadastre-se</a></li>
        </ul>


      </div>
    </nav>
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