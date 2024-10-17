<style>
  .sticky-nav {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 6;
    /* Maior para ficar acima do nav 2 */
  }

  .nav-wrapper {
    display: flex;
    justify-content: space-between;
  }

  .breadcrumb-container {
    display: flex;
    align-items: center;
  }

  .breadcrumb-container li {
    display: inline;
  }

  .nav_color2 {
    top: 64px;
  }

  .logolink {
    padding: 0 !important;
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

<nav class="nav_color sticky-nav">
  <div class="nav-wrapper">
    <!-- Lado direito -->
    <ul class="left hide-on-med-and-down">
      <li><a href="index.php" class="logolink"><img src="img/geolab-branco.png" alt="Logo do site" height="60" width="auto"></a></li>
      <li class="breadcrumb-container"><?= $breadcrumb ?></li>
    </ul>
    <!-- Lado esquerdo -->
    <ul class="right hide-on-med-and-down">
      <li><a href="index.php">Início</a></li>
      <li><a href="crud/editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="perfil-container"><?= $dados['nome']; ?>
          <img src="img/usuarios/<?= $img; ?>"></a></li>
    </ul>
  </div>
  <nav class="nav_color2 sticky-nav">
    <ul class="left hide-on-med-and-down">
      <li><a href="rank.php">Colaboradores</a></li>
    </ul>

    <ul class="right hide-on-med-and-down">
      <li><button id="toggleDarkMode" class="toggle-button">Alternar Modo</button></li>
    </ul>
  </nav>
</nav>

<script>
  $(document).ready(function() {
    $(window).scroll(function() {
      if ($(window).scrollTop() > 0) {
        $('nav').addClass('sticky-nav');
      } else {
        $('nav').removeClass('sticky-nav');
      }
    });
  });
</script>