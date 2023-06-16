<?php
    require('../conn.php');

    $id_produtoRA = $_POST['id_produtoRA'];
    $situacao_produtoR = $_POST['situacao_produtoRA'];

    $getQuantidadeAtual = $pdo->prepare("SELECT qtd_produtoR FROM produtosretornaveis WHERE id_produtoR = :id_produtoR");
    $getQuantidadeAtual->bindValue(':id_produtoR', $id_produtoRA, PDO::PARAM_INT);
    $getQuantidadeAtual->execute();
    $quantidadeAtual = $getQuantidadeAtual->fetchColumn();
    

    
    $getQuantidadeDevendo = $pdo->prepare("SELECT qtd_emprR FROM produtosretornaveis WHERE id_produtoR = :id_produtoR");
    $getQuantidadeDevendo->bindValue(':id_produtoR', $id_produtoRA, PDO::PARAM_INT);
    $getQuantidadeDevendo->execute();
    $quantidadeDevendo = $getQuantidadeDevendo->fetchColumn();
    $quantidadeFinal = $quantidadeAtual + $quantidadeDevendo;

    $devolver_produto = $pdo->prepare("UPDATE produtosretornaveis SET situacao_produtoR = 0, qtd_produtoR = :quantidadeFinal WHERE id_produtoR = :id_produtoR;");
    
    $devolver_produto->execute(array(
        ':id_produtoR' => $id_produtoRA,
        ':quantidadeFinal' => $quantidadeFinal
    ));

    header("Location: ../tabelasPR.php");
    echo 'sucesso';
?>