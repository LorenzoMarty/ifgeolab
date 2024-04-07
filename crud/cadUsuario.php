<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <title>If GeoLab</title>
</head>

<body>
    <?php
if (isset($_COOKIE['acesso'])){
    if($_COOKIE['acesso']['permissao'] == 1) {
       include "topo-user.php";
   } elseif ($_COOKIE['acesso']['permissao'] == 2) {
       include "topo-adm.php";
   }} else {
       include "topo.php";
   }
   ?>
    <main>
        <div class="container">
            <h1>Cadastrar Usuário</h1>
            <hr>
            <div class="row">
                <div class="col s12">
                    <form action="processaUsuario.php" method="POST" enctype="multipart/form-data">

                        <div class="input-field">
                            <label>Nome</label>
                            <input type="text" name="nome" required="required" />
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="usuário@email.com" required="required" />
                        </div>

                        <div class="input-field">
                            <label>Senha</label>
                            <input type="password" name="senha" required="required" />
                        </div>

                        <div class="input-field">
                            <label>Telefone</label>
                            <input type="text" name="tel" required="required" id="telefone" />
                        </div>

                        <div class="input-field">
                            <label>Matrícula</label>
                            <input type="text" name="matricula" required="required" />
                        </div>

                        <div class="input-field col s12">
                            <label>Imagem:</label><br><br>
                            <input type="file" name="arquivo"/><br><br>
                            <button class="waves-effect waves-light btn green" type="submit" name="cadastrar">Cadastrar</button>
                        </div>

                    </form>
                </div>
            </div>

            <hr>
        </div>
    </main>
    <br><br><br><br>
    <?php
    include "footer.php";
    ?>

<script>
  $(document).ready(function() {
    // Aplica a máscara para o campo de telefone
    $('input[name="tel"]').inputmask({
      mask: ['(99)9999-9999', '(99)9-9999-9999'],
      keepStatic: true,
      placeholder: ''
    });
  });
</script>
</body>

</html>