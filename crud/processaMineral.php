<?php
include_once ('../conecta.php');
$conexao = conectar();
$sql = "SELECT MAX(idmineral) as umineral FROM mineral";
$result = mysqli_query($conexao, $sql);
$dado = mysqli_fetch_assoc($result);
$x = $dado['umineral'];

if (isset ($_POST['editar'])) {
    
    $id = $_POST['idmineral'];
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $descricao = $_POST['desc'];
    $suges = $_POST['sugestao'];
    
    if (isset ($_FILES['arquivo'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        
        //define o nome do arquivo
        $novo_nome = "mineral_" . ($x + 1) . $extensao;

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/mineral/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        
        $sql = "UPDATE mineral SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges' WHERE idmineral=$id";
        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Amostra atualizada com sucesso!');
            location.href='../index.php'</script>";
        } else {
            echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarMineral.php'</script>";
        }
    }
    header('Location: ../index.php');
}elseif (isset ($_GET['deletar'])) {
    $id = $_GET['deletar'];

    $sql = "DELETE FROM mineral WHERE idmineral=$id";
    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Amostra deletada com sucesso!');
        location.href='../index.php'</script>";
    } else {
        echo "<script>alert('Não foi possível deletar a amostra!');
        location.href='../index.php'</script>";
    }
} else {
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $desc = $_POST['desc'];
    $suges = $_POST['sugestao'];

    if (isset ($_FILES['arquivo'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        //define o nome do arquivo
        $novo_nome = "mineral_" . ($x + 1) . $extensao;

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/mineral/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        //cadastra no banco
        $sql = "INSERT INTO mineral (nome, idcat, descricao, img, sugestao) VALUES ('$nome', '$cat', '$desc', '$novo_nome', '$suges')";

        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Cadastro realizado com sucesso!');
        location.href='../index.php'</script>";
        } else {
            echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='../index.php'</script>";
        }
    }
}