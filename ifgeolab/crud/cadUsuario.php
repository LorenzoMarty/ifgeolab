<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "include.php"; ?>
    <link rel="stylesheet" href="../css/image.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet' />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous" type="text/javascript"></script>
    <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        rel = 'stylesheet' >
            $(document).ready(function() {
                // Aplica a máscara para o campo de telefone
                $("#telefone").mask("(00)0-0000-0000");
            })
    </script>
    <title>IF GeoLab</title>
</head>

<body>
    <?php
    $breadcrumb = "";
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
                            <input class="white-text" type="text" name="nome" required />
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input class="white-text" type="email" name="email" placeholder="usuário@email.com" required />
                        </div>

                        <div class="input-field">
                            <label>Senha</label>
                            <input class="white-text" type="password" name="senha" required />
                        </div>

                        <div class="input-field">
                            <label>Telefone</label>
                            <input class="white-text" id="telefone" type="text" name="tel" required />
                        </div>

                        <div class="input-field">
                            <label>Matrícula</label>
                            <input class="white-text" type="text" name="matricula" required="required" />
                        </div>

                        <div class="input-field">
                            <label>Instituição</label>
                            <input class="white-text" type="text" name="inst" required="required" />
                        </div>
                        <div class="img-area" data-img="">
                            <i class='bx bxs-cloud-upload icon'></i>
                            <h3>Envie uma Foto de Perfil</h3>
                            <p>A Imagem não pode ser maior que <span>20MB</span></p>
                            <input name="arquivo" type="file" id="Capa" style="display: none;">
                        </div>
                        <div class="input-field col s12">
                            <button class="waves-effect waves-light btn green" type="submit" name="cadastrarUsuario">Cadastrar</button>
                        </div>
                </div>
            </div>
        </div>
        </form>
    </main>
    <?php
    include "footer.php";
    ?>
    <script src="../js/image.js"></script>