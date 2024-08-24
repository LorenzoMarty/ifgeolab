<style>
  .sticky-nav {
    position: -webkit-sticky;
    /* Safari */
    position: sticky;
    top: 0;
    z-index: 5;
  }

  .breadcrumb-container {
    display: flex;
    align-items: center;
  }

  .breadcrumb-container li {
    display: inline;
  }
</style>
<?php

require_once('conecta.php');
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
      <div class="col s12 center">
        <a href="index.php">
          <img src="img/geolab-branco.png" alt="Logo do site" height="100" width="auto">
        </a>
      </div>
    </div>
  </header>

  <nav class="nav_color">
    <div class="nav-wrapper">
      <!-- Lado direito -->
      <ul class="left hide-on-med-and-down">
        <li><button id="toggleDarkMode" class="toggle-button">Alternar Modo</button></li>
        <li><a class="white-text" href="index.php">Início</a></li>
        <li class="breadcrumb-container"><?= $breadcrumb ?></li>
      </ul>
      <!-- Lado esquerdo -->
      <ul class="right hide-on-med-and-down">
        <li><a class="white-text" href="rank.php">Colaboradores</a></li>
        <li><a class="white-text" href="crud-usuario/Amostra.php">Sugestão</a></li>
        <li style="margin-right: 10px;"><a class="white-text" href="crud/editUser.php"><?php echo $dados['nome']; ?></a></li>
        <li style="margin-right: 10px;"><img src="img/usuarios/<?= $img; ?>" class="perfil materialboxed "></li>
      </ul>
    </div>
  </nav>
  
  <script>
    $(document).ready(function() {

      $(window).scroll(function() {

        if ($(window).scrollTop() > 150) {

          $('nav').addClass('sticky-nav');

        } else {

          $('nav').removeClass('sticky-nav');
        }

      });
    });
  </script>