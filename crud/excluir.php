<?php
require_once ('../conecta.php');
$conexao = conectar();

if (isset ($_GET['deletarMineral'])) {
    $id = $_GET['deletarMineral'];

    $sql = "DELETE FROM mineral WHERE idmineral=$id";
    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Amostra deletada com sucesso!');
        location.href='../index.php'</script>";
    } else {
        echo "<script>alert('Não foi possível deletar a amostra!');
        location.href='listarMineral.php'</script>";
    }
    } elseif (isset ($_GET['deletarRocha'])) {
        $id = $_GET['deletarRocha'];
    
        $sql = "DELETE FROM rocha WHERE idrocha=$id";
        if (mysqli_query($conexao, $sql)) {
            echo "<script>
        Swal.fire({
            title: 'Parabéns!'',
            text: 'Amostra deletada!',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = 'listarRocha.php';
            }
        });
    </script>";
        } else {
            echo "<script>alert('Não foi possível deletar a amostra!');
            location.href='listarRocha.php'</script>";
        }
    } elseif (isset($_GET['deletarUsuario'])) {
        $id = $_GET['deletarUsuario'];
    
        $sql = "DELETE FROM usuario WHERE idusuario=$id";
        if (mysqli_query($conexao, $sql)) {
            session_start();
            
            session_destroy();
            echo "<script>alert('Conta deletada com sucesso!');
            location.href='../login.php'</script>";
        } else {
            echo "<script>alert('Não foi possível deletar a conta!');
            location.href='editUser.php'</script>";
        }
    }
?>
<script src="../js/sweetalert.js"></script>