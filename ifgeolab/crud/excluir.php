<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

if (isset($_GET['deletarMineral'])) {
    $id = $_GET['deletarMineral'];

    $sql = "DELETE FROM mineral WHERE idmineral=$id";
    $sql2 = "DELETE FROM img_mineral WHERE idmineral=$id";
    if (mysqli_query($conexao, $sql) and mysqli_query($conexao, $sql2)) {
        $_SESSION['excluir'] = [
            'title' => 'Parabéns!',
            'text' => 'Amostra deletada!',
            'icon' => 'success'
        ];
        header("Location: listarMineral.php");
    } else {
        echo "<script>alert('Não foi possível deletar a amostra!');
        location.href='listarMineral.php'</script>";
    }
} elseif (isset($_GET['deletarRocha'])) {
    $id = $_GET['deletarRocha'];

    $sql = "DELETE FROM rocha WHERE idrocha=$id";
    $sql2 = "DELETE FROM img_rocha WHERE idrocha=$id";
    if (mysqli_query($conexao, $sql) and mysqli_query($conexao, $sql2)) {
        $_SESSION['excluir'] = [
            'title' => 'Parabéns!',
            'text' => 'Amostra deletada!',
            'icon' => 'success'
        ];
        header("Location: listarRocha.php");
    } else {
        echo "<script>alert('Não foi possível deletar a amostra!');
            location.href='listarRocha.php'</script>";
    }
} elseif (isset($_GET['deletarUsuario'])) {
    $id = $_GET['deletarUsuario'];

    $sql = "DELETE FROM usuario WHERE idusuario=$id";
    $_SESSION['excluir'] = [
        'title' => 'Parabéns!',
        'text' => 'Conta deletada!',
        'icon' => 'success'
    ];
    header("Location: ../login.php");
    if (mysqli_query($conexao, $sql)) {
        session_start();

        session_destroy();
    } else {
        echo "<script>alert('Não foi possível deletar a conta!');
            location.href='editUser.php'</script>";
    }
}
