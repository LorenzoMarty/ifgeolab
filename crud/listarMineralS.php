<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script src="../js/dark-light.js"></script>
    <title>IF GeoLab</title>
    <style>
        .minha-imagem {
            height: 220px;
            width: 600px;
            object-fit: cover;
        }

        .meu-span {
            background-color: rgba(0, 0, 0, 0.3);
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    $breadcrumbs = [
        'Amostra' => '> <a href="sugestao.php">Amostra</a>',
        'Minerais' => '<a href="listarMineralS.php">Minerais</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);

    if (isset($_SESSION['permissao'])) {
        if ($_SESSION['permissao'] == 1) {
            header('Location: ../index.php');
        } elseif ($_SESSION['permissao'] == 2) {
            include "topo-adm.php";
        }
    } else {
        header('Location: ../index.php');
    }
    ?>
    <main>

        </div>
        <div class="container center">
            <div class="row">
                <div class="col s12">
                    <h3>Minerais</h3><br>
                </div>

                <div class="col s12">
                    <hr>
                    <p>Mineral é um corpo natural sólido e cristalino formado em resultado da interação de processos
                        físico-químicos em ambientes geológicos. Cada mineral é classificado e denominado não apenas com
                        base na sua composição química, mas também na estrutura cristalina dos materiais que o compõem.
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM mineral WHERE sugestao=1";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql); ?>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th scope="col">Id Mineral</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Id Categoria</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <?php while ($dados = mysqli_fetch_array($resultado)) {
                        $idmineral = $dados["idmineral"];
                        $nome = $dados['nome'];
                        $cat = $dados['idcat'];
                        $descricao = $dados['descricao'];
                        $img = $dados['img'];
                        $obj = $dados['3d'];

                        echo "<td> " . $dados['idmineral'] . " </td>";
                        echo "<td>" . $dados['nome'] . " </td>";
                        echo "<td>" . $dados['idcat'] . " </td>";
                        echo "<td> <img src=../img/mineral/" . $dados['img'] . " width='50px' height='auto'></td>";
                        echo "<td><a class='center waves-effect waves-light btn-small blue' href='editMineral.php?idmineral=" . $dados['idmineral'] . "&sugestao=0'>Editar</a>";
                        echo " <a class='center waves-effect waves-light btn-small green' href='editar.php?idmineral=" . $dados['idmineral'] . "&sugestao=0'>Aceitar</a>";
                        echo " <a id='btnExcluir-" . $dados['idmineral'] . "' class='center waves-effect waves-light btn-small red' data-idmineral='" . $dados['idmineral'] . "'>Excluir</a></td>";
                        echo '</tr>';
                    } ?>
                </table>
            </div>
        </div>
        <br><br><br>
    </main>

    <?php include "footer.php"; ?>

    <script src="../js/sweetalert.js"></script>
    <script>
        document.querySelectorAll('[id^="btnExcluir-"]').forEach(button => {
            button.addEventListener('click', function() {
                const idmineral = this.getAttribute('data-idmineral');
                Swal.fire({
                    title: "Tem certeza que deseja excluir o mineral?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "excluir.php?deletarMineral=" + idmineral;
                    }
                });
            });
        });
    </script>

</body>

</html>