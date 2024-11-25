<style>
  .sticky-nav {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 6;
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

  .perfil-container img {
    height: 30px;
    width: 30px;
    border-radius: 50%;
    margin-left: 10px;
  }

  .sidenav {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100vh;
  }

  .sidenav-content {
    flex-grow: 1;
  }

  .logo-footer {
    text-align: center;
    padding: 20px 0;
  }
</style>

<?php
require_once('../conecta.php');
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_SESSION['id'];
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
  $dados = mysqli_fetch_assoc($resultado);
  $img = $dados['img'];
}
?>

<nav class="nav_color sticky-nav">
  <div class="nav-wrapper">

    <!-- Lado direito - Aparece apenas em telas grandes -->
    <ul class="left hide-on-med-and-down">
      <li><a href="../index.php" class="logolink"><img src="../img/geolab-branco.png" alt="Logo do site" height="60"
            width="auto"></a></li>
      <li class="breadcrumb-container"><?= $breadcrumb ?></li>
    </ul>

    <!-- Lado esquerdo - Aparece apenas em telas grandes -->
    <ul class="right hide-on-med-and-down">
      <li><a href="../index.php">Início</a></li>
      <li>
        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Cadastrar<i
            class="material-icons right">arrow_drop_down</i></a>
      </li>
      <li><a href="editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="perfil-container"><?= $dados['nome']; ?>
          <img src="../img/usuarios/<?= $img; ?>" alt="Imagem de perfil"></a></li>
    </ul>

    <ul class="left hide-on-large-only">
      <li><a href="../index.php" class="logolink"><img src="../img/geolab-branco.png" alt="Logo do site" height="60"
            width="auto"></a></li>
    </ul>

    <ul class="right hide-on-large-only">
      <li><a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>
    </ul>
  </div>

  <nav class="nav_color2 sticky-nav">
    <ul class="left">
      <li><a href="../rank.php">Colaboradores</a></li>
    </ul>
    <ul class="right">
      <li><button id="toggleDarkMode" class="toggle-button">Alternar Modo</button></li>
    </ul>
  </nav>
</nav>

<!-- Dropdown Content (Desktop) -->
<ul id="dropdown1" class="dropdown-content">
  <?php if ($_SESSION['permissao'] == 3): ?>
    <li><a href="listarUsuario.php">Usuários</a></li>
  <?php endif; ?>
  <li><a href="cadquestao.php">Questões</a></li>
  <li><a href="Sugestao.php">Sugestões</a></li>
  <li><a href="Amostra.php">Amostras</a></li>
</ul>

<!-- Mobile Sidenav (menu lateral) -->
<ul class="sidenav white-text #212121 grey darken-4" id="mobile-demo">
  <!-- Conteúdo da sidebar -->
  <div class="sidenav-content">
    <li><a class="sidenav-close white-text" href="#!"><i class="material-icons white-text">clear</i>Fechar</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="white-text" href="../index.php">Início</a></li>
    <?php if ($_SESSION['permissao'] == 3): ?>
      <li><a class="white-text" href="listarUsuario.php">Usuários</a></li>
    <?php endif; ?>
    <li><a class="white-text" href="cadquestao.php">Cadastrar Questões</a></li>
    <li><a class="white-text" href="Sugestao.php">Cadastrar Sugestões</a></li>
    <li><a class="white-text" href="Amostra.php">Cadastrar Amostras</a></li>
    <li><a href="editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="white-text perfil-container">
        <img src="../img/usuarios/<?= $img; ?>" alt="Imagem de perfil"> <?= $dados['nome']; ?></a></li>
    <hr>
  </div>
  <div class="logo-footer">
    <img class="responsive-img" src="../img/geolab-branco.png" alt="Logo IFGeoLab">
  </div>
</ul>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, {
      click: true
    });

    // Inicializar Sidenav (menu lateral para mobile)
    var sidenavElems = document.querySelectorAll('.sidenav');
    var sidenavInstances = M.Sidenav.init(sidenavElems, {
      edge: 'right'
    });
  });
</script>