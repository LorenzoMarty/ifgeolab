<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js">
    <link rel="stylesheet" href="../dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="../dist/plugins/upload/trumbowyg.upload.min.js">
    <link rel="stylesheet" href="../dist/plugins/emoji/trumbowyg.emoji.min.js">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <script src="../js/dark-light.js"></script>
    <title>IF GeoLab</title>
    <style>
        .minha-imagem {
            height: 220px;
            width: 220px;
            object-fit: cover;
        }

        nav.nav-center ul {
            text-align: center;
        }

        .li a:hover {
            background-color: #eee;
            color: black;
        }

        .li a.active {
            color: #000;
        }

        .li a {
            color: #fff;
            border-right: solid 1px grey;
        }

        nav.nav-center ul li {
            display: inline;
            float: none;
        }

        nav.nav-center ul li a {
            display: inline-block;
        }

        #fot {
            background: linear-gradient(45deg, #212121 24%, rgba(255, 255, 255, 1) 24%);
        }

        footer {
            padding: 30px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    $breadcrumbs = [
        'Amostra' => '> <a href="amostra.php">Cadastrar</a>',
        'Rochas' => '<a href="listarRocha.php">Rochas</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);

    require_once '../conecta.php';
    $conexao = conectar();

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            header('Location: ../index.php');
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        header('Location: ../index.php');
    }

    if (isset ($_GET['idrocha'])) {
    $id = $_GET['idrocha'];
    $sql = "SELECT * FROM rocha WHERE idrocha=$id";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);
    $descricao = $dados['descricao'];
    $nome = $dados['nome'];
    if($dados['sugestao'] == "0"){
        $suges = $dados['sugestao'];
    }else{
        $suges = $_GET['sugestao'];
    }
    
    }
    ?>
    <div class="container">
        <h4>Editar Rocha</h4>
        <hr>
        <form enctype="multipart/form-data" method="post" action="editar.php" class="col  s12 m6">

            <div class="row">
                <div class="input-field col s6">
                    <input id="nome" name="nome" type="text" value="<?php echo $nome; ?>" class="validate">
                    <input type="hidden" name="idrocha" value="<?php echo $id; ?>">
                    <input type="hidden" name="sugestao" value="<?php echo $suges; ?>">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s6">
                    <select name="idcat" class="validate">
                        <?php
                        require_once "../conecta.php";
                        $conexao = conectar();
                        $y = "SELECT * FROM catrocha";
                        $res = mysqli_query($conexao, $y);
                        while ($dad = mysqli_fetch_assoc($res)) {
                        ?>
                            <option value="<?php echo $dad['idcat']; ?>">
                                <?php echo $dad['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="trumbowyg-editor" name="desc" class="materialize-textarea"><?php echo $dados['descricao']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label>Imagem:</label><br><br>
                    <div class="col s3">
                        <img src="../img/rochas/<?= $dados['img']; ?>" class="minha-imagem materialboxed ">Foto
                        atual</img>
                    </div>
                    <input type="file" name="arquivo" value="<?php echo $dados['img']; ?>" /> <br>
                </div>
                <div class="input-field col s12">
                    <button class="waves-effect waves-light btn green" type="submit" name="editarRocha">Editar</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="../dist/trumbowyg.min.js"></script>
    <script src="../dist/plugins/upload/trumbowyg.upload.min.js"></script>

    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <!-- Import Trumbowyg plugins... -->
    <script src="../dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
    <script src="../dist/plugins/insertaudio/trumbowyg.insertaudio.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>

    <script>
        $('#trumbowyg-editor').trumbowyg({
            btns: [
                ['viewHTML'],
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                ['upload'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ],
            plugins: {
                // Add imagur parameters to upload plugin for demo purposes
                upload: {
                    serverPath: '../dicas-curiosidades-matematicas/upload.php',
                    fileFieldName: 'image',
                    headers: {
                        'Authorization': 'Client-ID xxxxxxxxxxxx'
                    },
                    urlPropertyName: 'file'
                }
            },
            autogrow: true

        });
    </script>

</body>

</html>