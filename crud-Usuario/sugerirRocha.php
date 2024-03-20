<?php
include_once ('../conecta.php');
$conexao = conectar();

$nome = $_POST['nome'];
$cat = $_POST['idcat'];
$desc = $_POST['desc'];

if (isset ($_FILES['arquivo'])) {

    //pega a extensao do arquivo
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

    //define o nome do arquivo
    $novo_nome = "rocha_" . ($x + 1) . $extensao;

    //define a pasta para onde enviaremos o arquivo
    $diretorio = "../img/rocha/";

    //faz o upload, movendo o arquivo para a pasta especificada
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

    //cadastra no banco
    $sql = "INSERT INTO sugerirrocha (nome, idcat, descricao, img) VALUES ('$nome', '$cat', '$desc', '$novo_nome')";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Cadastro realizado com sucesso!');
        location.href='index.php'</script>";
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='index.php'</script>";
    }
}