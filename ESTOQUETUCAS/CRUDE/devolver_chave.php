<?php
    require('../conn.php');

    $id_chave = $_POST['id_chave'];
    $disponivel_chave = $_POST['disponivel_chave'];


    require("../protected.php");

    if (isset($_SESSION['id'])) {
        $usuarioLogadoId = $_SESSION['id'];
    } else {
        echo('Não foi');
    }
    
    $sqlPerfilLogin = "SELECT login FROM usuarios WHERE id = :usuarioLogadoId";
    $resultPerfilLogin = $pdo->prepare($sqlPerfilLogin);
    $resultPerfilLogin->execute(array(':usuarioLogadoId' => $usuarioLogadoId));
    $resultado = $resultPerfilLogin->fetch();
    $nome_usuario_logado = $resultado['login'];

    $devolver_chave = $pdo->prepare("UPDATE chaves SET disponivel_chave = 0, responsavel = :responsavel WHERE id_chave = :id_chave;");

    $devolver_chave->execute(array(
        ':id_chave' => $id_chave,
        ':responsavel' => $nome_usuario_logado
    ));

    header("Location: ../tabelasChave.php");
    echo 'sucesso';
?>
