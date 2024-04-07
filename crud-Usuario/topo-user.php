<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>
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

    .perfil {
      margin-top: 5px;
      height: 50px;
      width: 50px;
      border-radius: 50%;
      object-fit: cover;
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <title>IF GeoLab</title>
</head>
<?php

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
        <ul class="right hide-on-med-and-down">
        <li><a class="white-text" href="Amostra.php">Sugestões</a></li>
          <li style="margin-right: 10px;"><a class="white-text" href="../crud/editUser.php"><?php echo $dados['nome']; ?></a></li>
          <li style="margin-right: 10px;"><img src="../img/usuarios/<?= $img; ?>" class="perfil materialboxed "></li>
        </ul>


      </div>
    </nav>
    <!-- topbar para tela pequena  !-->
    <ul class="sidenav white-text #212121 grey darken-4 " style="width: 350px;" id="telefone-nav">
      <li><a class="sidenav-close white-text" href="#!"><i class="material-icons white-text">clear</i>Menu lateral</a></li>
      <li>
        <div class="divider"></div>
      </li>
      <li><a class="white-text" href="../index.php">Início</a></li>
      <hr>
      <ul style="margin-left: 33px;">
        <li style="margin-right: 10px;"><?php echo $dados['nome']; ?></li>
        <li style="margin-right: 10px;"><img src="../img/usuarios/<?= $img; ?>" class="perfil materialboxed "></li>
      </ul>
      <hr>
      <div class="row">
        <div class="center-align ">
          <img class="responsive-img" src="../img/geolab-branco.png" alt="Logo do Jornal UPGD-IFFar">
        </div>
      </div>
    </ul>
  </header>
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