<?php
    require('../conn.php');

    $vista_chave = $_POST['vista_chave'];
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

    $emprestar_chave = $pdo->prepare("UPDATE chaves SET vista_chave = 
    :vista_chave, disponivel_chave = 1,responsavel = :responsavel WHERE id_chave = :id_chave");
    
    $emprestar_chave->execute(array(
        ':vista_chave' => $vista_chave,
        ':id_chave' => $id_chave,
        ':responsavel'=> $nome_usuario_logado
    ));

    header("Location: ../tabelasChave.php");
    echo 'sucesso';
?>
