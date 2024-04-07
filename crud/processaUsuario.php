<?php
include_once ('../conecta.php');
$conexao = conectar();
$sql = "SELECT MAX(idusuario) as user FROM usuario";
$result = mysqli_query($conexao, $sql);
$dado = mysqli_fetch_assoc($result);

if (isset($_POST['editar'])) {

    $id = $_COOKIE['acesso']['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaE = $_POST['senha'];
    $telefone = $_POST['tel'];
    $matricula = $_POST['matricula'];

    if (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome-" . $id . $extensao;

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $hash = password_hash($senhaE, PASSWORD_DEFAULT);
        if ($hash) {
            $sql = "UPDATE usuario SET nome='$nome', email = '$email', senha = '$hash', telefone='$telefone', img = '$novo_nome', matricula = '$matricula' WHERE idusuario=$id";

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
    } else {
        $hash = password_hash($senhaE, PASSWORD_DEFAULT);
        if (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 1) {
            $novo_nome = "usuario.png";
        } elseif (isset($_COOKIE['acesso']) && $_COOKIE['acesso']['permissao'] == 2) {
            $novo_nome = "adm.png";
        }
        if ($hash) {
            $sql = "UPDATE usuario SET nome='$nome', email = '$email', senha = '$hash', telefone='$telefone', img = '$novo_nome', matricula = '$matricula' WHERE idusuario=$id";

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
    }
    header('Location: ../index.php');
} elseif (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];

    $sql = "DELETE FROM usuario WHERE idusuario=$id";
    if (mysqli_query($conexao, $sql)) {
        setcookie("acesso[usuario]", '', time() - 7200);
        setcookie("acesso[email]", '', time() - 7200);
        setcookie("acesso[permissao]", '', time() - 7200);
        setcookie("acesso[id]", '', time() - 7200);
        echo "<script>alert('Conta deletada com sucesso!');
        location.href='editUser.php'</script>";
    } else {
        echo "<script>alert('Não foi possível deletar a conta!');
        location.href='../index.php'</script>";
    }
} else {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['tel'];
    $matricula = $_POST['matricula'];

    if (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome-" . $id . $extensao;

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $hash = password_hash($senha, PASSWORD_DEFAULT);

        if ($hash) {
            $sql = "INSERT INTO usuario(nome, email, senha, telefone, img, matricula) VALUES ('$nome','$email', '$hash', '$telefone', '$novo_nome', '$matricula')";

            if (mysqli_query($conexao, $sql)) {
                echo "<script>alert('Cadastro realizado com sucesso!');
        location.href='../login.php'</script>";
            } else {
                echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='cadUsuario.php'</script>";
            }
        } else {
            echo "Erro na encriptografia da senha!!!!";
        }
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $novo_nome = "usuario.png";
        if ($hash) {
            $sql = "INSERT INTO usuario(nome, email, senha, telefone, img, matricula) VALUES ('$nome','$email', '$hash', '$telefone', '$novo_nome', '$matricula')";

            if (mysqli_query($conexao, $sql)) {
                echo "<script>alert('Cadastro realizado com sucesso!');
        location.href='../login.php'</script>";
            } else {
                echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='cadUsuario.php'</script>";
            }
        } else {
            echo "Erro na encriptografia da senha!!!!";
        }
    }
}