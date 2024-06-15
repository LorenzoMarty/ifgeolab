<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/materialize.css">
<style>
  .sticky-nav {
    position: -webkit-sticky;
    /* Safari */
    position: sticky;
    top: 0;
    z-index: 5;
  }
</style>
<?php

require_once ('../conecta.php');
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
      <div class="col s12 center" style="margin-top: 0.2%;">
        <a href="../index.php">
          <img src="../img/geolab-branco.png" alt="Logo do site" height="100" width="auto">
        </a>
      </div>
    </div>
  </header>

  <nav class="nav_color">
    <div class="nav-wrapper">
      <!-- Lado direito -->
      <ul class="leFt hide-on-med-and-down">
        <li><a href="../index.php">Início</a></li>
      </ul>
      <!-- Lado esquerdo -->
      <ul class="right hide-on-med-and-down">
        <li><a href="../rank.php">Colaboradores</a></li>
        <?php if($_SESSION['permissao'] == 3){
        echo '<li><a href="listarUsuario.php">Usuários</a></li>';
        }
        ?>
        <li><a href="Sugestao.php">Amostra</a></li>
        <li><a href="Amostra.php">Cadastrar</a></li>
        <li style="margin-right: 10px;"><a href="editUser.php?idusuario=" .<?php $_SESSION['id']; ?>><?php echo $dados['nome']; ?></a></li>
        <li style="margin-right: 10px;"><img src="../img/usuarios/<?= $img; ?>" class="perfil materialboxed "></li>
      </ul>
    </div>
  </nav>

  <!-- topbar para tela pequena  !-->
  <ul class="sidenav white-text #212121 grey darken-4 " style="width: 350px;" id="telefone-nav">
    <li><a class="sidenav-close white-text" href="#!"><i class="material-icons white-text">clear</i>Menu lateral</a>
    </li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="white-text" href="igneas.php">Ígneas</a></li>
    <li><a class="white-text" href="met.php">Metamórficas</a></li>
    <li><a class="white-text" href="sed.php">Sedimentares</a></li>
    <hr>
    <ul style="margin-left: 33px;">
      <li><a class="white-text" href="cadAmostra.php">Cadastrar Amostra</a></li>
      <li style="margin-right: 10px;"><a class="white-text" href="editUser.php?idusuario=" .<?php $_SESSION['id']; ?>><?php echo $dados['nome']; ?></a></li>
      <li style="margin-right: 10px;"><img src="img/usuarios/<?= $img; ?>" class="perfil materialboxed "></li>
    </ul>
    <hr>
    <div class="row">
      <div class="center-align ">
        <img class="responsive-img" src="img/geolab-branco.png" alt="Logo do Jornal UPGD-IFFar">
      </div>
    </div>
  </ul>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.materialboxed');
      var instances = M.Materialbox.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function () {
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
  </body>
</html>