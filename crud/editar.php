<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

if (isset($_POST['editarMineral'])) {
    $obj = $_POST['3d'];
    $id = $_POST['idmineral'];
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $descricao = $_POST['desc'];
    $suges = $_POST['sugestao'];

    if (isset($_FILES['arquivo'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        //define o nome do arquivo
        $novo_nome = "$nome" . $extensao;

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/mineral/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "UPDATE mineral SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges', 3d='$obj' WHERE idmineral=$id";
        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Amostra atualizada com sucesso!');
            location.href='../index.php'</script>";
        } else {
            echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarMineral.php'</script>";
        }
    }
} elseif (isset($_POST['editarRocha'])) {
    $obj = $_POST['3d'];
    $id = $_POST['idrocha'];
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $descricao = $_POST['desc'];
    $suges = $_POST['sugestao'];

    if (isset($_FILES['arquivo'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        //define o nome do arquivo
        $novo_nome = "$nome" . $extensao;

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/rochas/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "UPDATE rocha SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges', 3d='$obj' WHERE idrocha=$id";
        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Amostra atualizada com sucesso!');
        location.href='../index.php'</script>";
        } else {
            echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarRocha.php'</script>";
        }
    }
} elseif (isset($_POST['editarUsuario'])) {

    $id = $_POST['idusuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaE = $_POST['senha'];
    $telefone = $_POST['tel'];
    $matricula = $_POST['matricula'];
    $inst = $_POST['inst'];

    if (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome-" . $id . "." . $extensao;

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    }
    $hash = password_hash($senhaE, PASSWORD_DEFAULT);
    if ($hash) {
        $sql = "UPDATE usuario SET nome='$nome', email = '$email', senha = '$hash', telefone='$telefone', img = '$novo_nome', matricula = '$matricula', instituto = '$inst' WHERE idusuario=$id";

        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Cadastro atualizado com sucesso!');
            location.href='../index.php'</script>";
        } else {
            echo "<script>alert('Não foi possível atualizar o cadastro!');
            </script>";
        }
    } else {
        echo "Erro na encriptografia da senha!!!!";
    }
} elseif (isset($_GET['idmineral'])) {

    $id = $_GET['idmineral'];
    $suges = $_GET['sugestao'];

    $sql = "UPDATE mineral SET sugestao='$suges' WHERE idmineral=$id";
    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Amostra atualizada com sucesso!');
            location.href='../index.php'</script>";
    } else {
        echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarMineralS.php'</script>";
    }
} elseif (isset($_GET['idrocha'])) {

    $id = $_GET['idrocha'];
    $suges = $_GET['sugestao'];

    $sql = "UPDATE rocha SET sugestao='$suges' WHERE idrocha=$id";
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Amostra cadastrada!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarRochaS.php'</script>";
    }
}