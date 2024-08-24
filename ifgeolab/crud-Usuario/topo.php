<style>
  .sticky-nav {
    position: -webkit-sticky;
    /* Safari */
    position: sticky;
    top: -1px;
    z-index: 1;
  }
</style>
<header>
  <div class="row">
    <div class="col s12 center">
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