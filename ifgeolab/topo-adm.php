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

  .logo-iff {
    height: 60px;
    width: auto;
    margin-left: 20px;
  }

  .logo-iff-mobile,
  .perfil-mobile {
    height: 40px;
    width: 40px;
    border-radius: 50%;
  }

  /* Para ajustar o ícone de menu na direita */
  .sidenav-trigger-right {
    position: absolute;
    right: 20px;
  }

  /* Novo estilo para a sidebar (sidenav) */
  .sidenav {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100vh; /* Altura total da viewport */
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
require_once('conecta.php');
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_SESSION['id'];
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
  $dados = mysqli_fetch_assoc($resultado);
  $img = $dados['img'];
}
?>

<!-- Navbar para Desktop e Mobile -->
<nav class="nav_color sticky-nav">
  <div class="nav-wrapper">
    <!-- Logo do site -->
    <a href="index.php" class="logolink"><img src="img/geolab-branco.png" alt="Logo do site" height="60" width="auto"></a>

    <!-- Menu Hamburger (apenas para mobile) - lado direito -->
    <a href="#" data-target="mobile-demo" class="sidenav-trigger sidenav-trigger-right"><i class="material-icons">menu</i></a>

    <!-- Lado esquerdo (Desktop) -->
    <ul class="left hide-on-med-and-down">
      <li class="breadcrumb-container"><?= $breadcrumb ?></li>
    </ul>

    <!-- Lado direito (Desktop) -->
    <ul class="right hide-on-med-and-down">
      <li><a href="index.php">Início</a></li>
      <?php if ($_SESSION['permissao'] == 3): ?>
        <li><a href="listarUsuario.php">Usuários</a></li>
      <?php endif; ?>
      <li>
        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Cadastrar<i class="material-icons right">arrow_drop_down</i></a>
      </li>
      <li><a href="crud/editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="perfil-container"><?= $dados['nome']; ?>
          <img src="img/usuarios/<?= $img; ?>" alt="Imagem de perfil"></a></li>
    </ul>
  </div>


  <!-- Navbar secundária para Desktop e Mobile -->
  <nav class="nav_color2 sticky-nav">
    <ul class="left">
      <li><a href="rank.php">Colaboradores</a></li>
    </ul>
    <ul class="right">
      <li><button id="toggleDarkMode" class="toggle-button">Alternar Modo</button></li>
    </ul>
  </nav>
</nav>

<!-- Dropdown Content (Desktop) -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="crud/cadquestao.php">Questões</a></li>
  <li><a href="crud/Sugestao.php">Sugestões</a></li>
  <li><a href="crud/Amostra.php">Amostras</a></li>
</ul>

<!-- Mobile Sidenav (menu lateral) -->
<ul class="sidenav white-text #212121 grey darken-4" id="mobile-demo">
  <!-- Conteúdo da sidebar -->
  <div class="sidenav-content">
    <li><a class="sidenav-close white-text" href="#!"><i class="material-icons white-text">clear</i>Fechar</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="white-text" href="index.php">Início</a></li>
    <?php if ($_SESSION['permissao'] == 3): ?>
      <li><a class="white-text" href="listarUsuario.php">Usuários</a></li>
    <?php endif; ?>
    <li><a class="white-text" href="rank.php">Colaboradores</a></li>
    <li><a class="white-text" href="crud/cadquestao.php">Cadastrar Questões</a></li>
    <li><a class="white-text" href="crud/Sugestao.php">Cadastrar Sugestões</a></li>
    <li><a class="white-text" href="crud/Amostra.php">Cadastrar Amostras</a></li>
    <li><a href="crud/editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="white-text perfil-container">
      <img src="img/usuarios/<?= $img; ?>" alt="Imagem de perfil"> <?= $dados['nome']; ?></a></li>
      <hr>
  </div>

  <!-- Logo na parte inferior -->
  <div class="logo-footer">
    <img class="responsive-img" src="img/geolab-branco.png" alt="Logo IFGeoLab">
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
