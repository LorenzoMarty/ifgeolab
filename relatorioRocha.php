<?php
include_once('conecta.php');
$conexao = conectar();
require './dompdf/vendor/autoload.php';

$idrocha = $_GET['idrocha'] ?? null;

if (!$idrocha) {
    die("ID da rocha não fornecido.");
}


$opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Content-Type: text/xml\r\n"."Accept-language: en\r\n" .
                "Cookie: foo=bar\r\n"
    )
  );
  
  $context = stream_context_create($opts);
  
  // Open the file using the HTTP headers set above
  $html = file_get_contents('http://localhost/ifgeolab/ifgeolab/pdfR.php?idrocha='.$idrocha, false, $context);

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setChroot(__DIR__);
$dompdf = new Dompdf($options);
//$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
@$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
