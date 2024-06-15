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
      <div class="col s12 center" style="margin-top: 0.2%;">
        <a href="../index.php">
          <img src="../img/geolab-branco.png" alt="Logo do site" height="100" width="auto">
        </a>
      </div>
    </div>
  </header>

  <nav class="nav_color" role="navigation">
    <div class="nav-wrapper">
      <!-- Lado direito -->
      <ul class="left hide-on-med-and-down">
        <li><a href="../index.php">Início</a></li>
      </ul>
      <!-- Lado esquerdo -->
      <ul class="right hide-on-med-and-down" style="margin-right: 20px;">
        <li><a href="../login.php">Login</a></li>
        <li><a href="../crud/cadUsuario.php">Cadastre-se</a></li>
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