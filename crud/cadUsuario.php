<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous" type="text/javascript"></script>
    <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
    <script src="../js/dark-light.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Aplica a máscara para o campo de telefone
            $("#telefone").mask("(00)0-0000-0000");
        })
    </script>
    <title>IF GeoLab</title>
</head>

<body>
    <?php

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            header('Location: ../index.php');
        } elseif ($_SESSION['permissao'] == 2) {
            header('Location: ../index.php');
        }
    } else {
        include "topo.php";
    }
    ?>
    <main>
        <div class="container">
            <h1>Cadastrar Usuário</h1>
            <hr>
            <div class="row">
                <div class="col s12">
                    <form action="cadastrar.php" method="POST" enctype="multipart/form-data">

                        <div class="input-field">
                            <label>Nome</label>
                            <input type="text" name="nome" required />
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="usuário@email.com" required />
                        </div>

                        <div class="input-field">
                            <label>Senha</label>
                            <input type="password" name="senha" required/>
                        </div>

                        <div class="input-field">
                            <label>Telefone</label>
                            <input id="telefone" type="text" name="tel" required />
                        </div>

                        <div class="input-field">
                            <label>Matrícula</label>
                            <input type="text" name="matricula" required="required" />
                        </div>

                        <div class="input-field">
                            <label>Instituição</label>
                            <input type="text" name="inst" required="required" />
                        </div>

                        <div class="input-field col s12">
                            <label>Imagem:</label><br><br>
                            <input type="file" name="arquivo" /><br><br>
                            <button class="waves-effect waves-light btn green" type="submit" name="cadastrarUsuario">Cadastrar</button>
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
</body>

</html>