<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-mineral-48.png" />
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="stylesheet" href="css/3d.css">
    <title>Document</title>

    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .img1 {
                align-items: left;
                margin-top: 60px;
                margin-right: 0px;
                margin-bottom: 10px;
                margin-left: 15px;
                max-width: 100px;
            }

            .img2 {
                margin-top: 30px;
                margin-left: 0px;
                margin-bottom: 10px;
                margin-right: 0px;
                max-width: 140px;
            }
            .img3 {
                margin-top: 30px;
                margin-left: 100px;
                margin-bottom: 10px;
                margin-right: 100px;
                max-width: 340px;
                align-items: center;
            }

            .text {
                margin-left: 10px;
                margin-right: 10px;
                font-size: large;
            }
            .title {
                font-size: large;
                text-align: center;
            }

            .cat {
                margin-left: 0%;
            }
        </style>
    </head>
    <?php
    include_once('conecta.php');
    $conexao = conectar();
    $idmineral = $_GET['idmineral'];

    $sql = "SELECT * FROM mineral WHERE idmineral =" . $idmineral;
    $resultado = mysqli_query($conexao, $sql);

    $dados = mysqli_fetch_assoc($resultado);
    $nome = $dados['nome'];
    $descricao = $dados['descricao'];
    $img = $dados['img'];
    $catJ = $dados['idcat'];
    $idrock = $dados['idmineral'];

    $j = "SELECT * FROM catmineral WHERE idcat='$catJ'";
    $res = mysqli_query($conexao, $j);
    while ($d = mysqli_fetch_array($res)) {
        $idcat = $d['idcat'];
        $name = $d['nome'];
    }
    if ($dados['idcat'] == $idcat) {
        $cat = $name;
    } else {
        echo "Erro ao buscar a categoria no banco de dados!";
    }
    ?>

<body>
    
        <div class="row">
            <div class="col s2"><img class="img1" src="img/if_logo.png"></div><br>
            <div class="title col s7">
                <h6><b>Instituto Federal de Educação, Ciência e Tecnologia Farroupilha Campus Avançado Uruguaiana</b></h6>
                <h5><b>MOSTRUÁRIO DIGITAL DE GEOGRAFIA IFGEOLAB</b></h5>
            </div>
            <div class="col s3"><img class="img2" src="img/geolab-verde.png"></div>
        </div>
        <div class="container">
            <div class="row">
                <hr>
                    <div class="wrapp">
                        <div class="card">
                            <div class="card__item">
                                <model-viewer class="card__model" loading="eager"
                                    style="background-color: rgb(255,255,255);" shadow-intensity="1"
                                    src="obj/obj1/gold.glb" alt="3d img2" camera-orbit="45deg 55deg" autoplay
                                    auto-rotate camera-controls ar ios-src="obj/obj1/scene.gltf"></model-viewer>
                                
                                    Ouro
                                
                            </div>
                                <h5><b>Categoria: </b><br><br>
                                    <?php echo $cat; ?>
                                </h5><br>
                        </div>
                    </div>
                
            </div>
        </div>

        <hr>
        <div class="container">
            <div class="col s12 m6 l4">
                <h5>
                    <?php echo $dados['descricao']; ?>
                </h5>
            </div>
            <hr>
        </div>
</body>

</html>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>