<?php
session_start();
require_once ('../conecta.php');
$conexao = conectar();

if (isset($_POST['cadastrarMineral'])) {
    $nome = $_POST['nome'];
    $cat = $_POST['cat'];
    $desc = $_POST['desc'];
    $suges = $_POST['sugestao'];
    $idusuario = $_POST['idusuario'];
    
    if (isset($_FILES['arquivo']) and isset($_FILES['3d'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        //define o nome do arquivo
        $novo_nome = "$nome" . $extensao;
        $obj = $_FILES['3d']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/mineral/";
        $pastaObj = "../obj/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        move_uploaded_file($_FILES['3d']['tmp_name'], $pastaObj . $obj);

        //cadastra no banco
        $sql = "INSERT INTO mineral(nome, idcat, descricao, img, sugestao, 3d, idusuario) VALUES ('$nome', '$cat', '$desc', '$novo_nome', '$suges', '$obj', '$idusuario')";
    } elseif (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome" . $extensao;

        $diretorio = "../img/rochas/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "INSERT INTO mineral(nome, idcat, descricao, img, sugestao, idusuario) VALUES ('$nome', '$cat', '$desc', '$novo_nome', '$suges', '$idusuario')";
    }
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Mineral cadastrado com sucesso!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='../index.php'</script>";
    }
} elseif (isset($_POST['cadastrarRocha'])) {
    $nome = $_POST['nome'];
    $cat = $_POST['cat'];
    $descricao = $_POST['desc'];
    $suges = $_POST['sugestao'];
    $idusuario = $_POST['idusuario'];

    if (isset($_FILES['arquivo']) and isset($_FILES['3d'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        //define o nome do arquivo
        $novo_nome = "$nome" . $extensao;
        $obj = $_FILES['3d']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/rochas/";
        $pastaObj = "../obj/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        move_uploaded_file($_FILES['3d']['tmp_name'], $pastaObj . $obj);

        //cadastra no banco

        $sql = "INSERT INTO rocha(nome, idcat, descricao, img, sugestao, 3d, idusuario) VALUES ('$nome', '$cat', '$descricao', '$novo_nome', '$suges', '$obj', '$idusuario')";
    } elseif (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome" . $extensao;

        $diretorio = "../img/rochas/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "INSERT INTO rocha(nome, idcat, descricao, img, sugestao, idusuario) VALUES ('$nome', '$cat', '$descricao', '$novo_nome', '$suges', '$idusuario')";
    }
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Rocha cadastrada com sucesso!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='../index.php'</script>";
    }
} elseif (isset($_POST['cadastrarUsuario'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['tel'];
    $matricula = $_POST['matricula'];
    $inst = $_POST['inst'];

    if (isset($_FILES['arquivo']) and $_FILES['arquivo']['size'] > 0) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome" . $extensao;

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    } else {
        $novo_nome = "usuario.png";
        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    }
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    if ($hash) {
        $sql = "INSERT INTO usuario(nome, email, senha, telefone, img, matricula, instituto) VALUES ('$nome','$email', '$hash', '$telefone', '$novo_nome', '$matricula', '$inst')";

        if (mysqli_query($conexao, $sql)) {
            $_SESSION['confirm'] = [
                "title" => 'Parabéns!',
                'text' => 'Cadastrado realizado com sucesso!',
                'icon' => 'success'
            ];
            header("Location: ../login.php");
        } else {
            echo "<script>alert('Não foi possível realizar o cadastro!');
        location.href='cadUsuario.php'</script>";
        }
    } else {
        echo "Erro na encriptografia da senha!!!!";
    }
}
?>