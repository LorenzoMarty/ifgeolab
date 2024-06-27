<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<?php
$breadcrumbs = [
  'Colaboradores' => '> <a href="rank.php">Colaboradores</a>'
];
$breadcrumb = implode('>', $breadcrumbs);
if (isset($_SESSION['permissao'])) {
  if ($_SESSION['permissao'] == 1) {
    include "topo-user.php";
  } elseif ($_SESSION['permissao'] == 2) {
    include "topo-adm.php";
  } elseif ($_SESSION['permissao'] != "1" && $_SESSION['permissao'] != "2") {
    include "topo.php";
  }
} else {
  include "topo.php";
}

require_once 'conecta.php';

$sql = "SELECT 
          usuario.nome, 
          COALESCE(mineral_contagem.quantidade_mineral, 0) AS quantidade_mineral, 
          COALESCE(rocha_contagem.quantidade_rocha, 0) AS quantidade_rocha
        FROM 
          usuario
        LEFT JOIN 
          (SELECT idusuario, COUNT(*) AS quantidade_mineral 
           FROM mineral 
           GROUP BY idusuario) AS mineral_contagem 
        ON 
          usuario.idusuario = mineral_contagem.idusuario
        LEFT JOIN 
          (SELECT idusuario, COUNT(*) AS quantidade_rocha 
           FROM rocha 
           GROUP BY idusuario) AS rocha_contagem 
        ON 
          usuario.idusuario = rocha_contagem.idusuario
";

$conexao = conectar();
$resultado = mysqli_query($conexao, $sql);

$grafico = [];
$quantidades = []; // Array para armazenar as quantidades totais para cada usuário

while ($dados = mysqli_fetch_array($resultado)) {
  $nome = $dados['nome'];
  $quantidade_mineral = $dados['quantidade_mineral'] !== null ? $dados['quantidade_mineral'] : 0;
  $quantidade_rocha = $dados['quantidade_rocha'] !== null ? $dados['quantidade_rocha'] : 0;
  $total_quantidade = $quantidade_mineral + $quantidade_rocha;
  $grafico[] = "['" . $nome . "', " . $quantidade_mineral . "," . $quantidade_rocha . "]";
  $quantidades[$nome] = $total_quantidade;
}

// Ordena o array $grafico com base nas quantidades totais
arsort($quantidades);
$graficoOrdenado = [];
foreach ($quantidades as $nome => $total) {
  foreach ($grafico as $dados) {
    if (strpos($dados, $nome) !== false) {
      $graficoOrdenado[] = $dados;
      break;
    }
  }
}

$grafico = implode(", ", $graficoOrdenado);
?>
<title>IF GeoLab</title>
<body>
<script src="js/dark-light.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var dataArray = [
        ['Nome', 'Minerais', 'Rochas'],
        <?php echo $grafico; ?>
      ];

      var data = google.visualization.arrayToDataTable(dataArray);

      var options = {
        chart: {
          title: 'Colaboradores',
          subtitle: 'Amostras Cadastradas',
        },
        colors: ['#6eaa5e', '#3b5534', '#03300b'],
        bars: 'vertical',
        hAxis: {
          textStyle: { color: '#808080' }, // Define a cor do texto do eixo horizontal como preto
          titleTextStyle: { color: '#588157' }, // Define a cor do título do eixo horizontal como preto
          gridlines: { color: '#707070' } // Define a cor das linhas de marcação do eixo X como preto
        },
        vAxis: {
          textStyle: { color: '#707070' }, // Define a cor do texto do eixo vertical como preto
          titleTextStyle: { color: '#808080' }, // Define a cor do título do eixo vertical como preto
          gridlines: { color: '#909090' } // Define a cor das linhas de marcação do eixo Y como preto
        },
        height: 400,
        width: 1000,
        backgroundColor: 'transparent',
        chartArea: {
          backgroundColor: 'transparent'
        },
        bar: { groupWidth: '70%' },
        legend: { position: 'top' } // Define a posição da legenda como 'top'
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
  <style>
    #barchart_material {
      margin: 0 auto;
      text-align: center;
      padding: 15px 10px 0;
    }
  </style>
  <div id="barchart_material"></div>
</body>
<?php include "footer.php"; ?>

</html>
