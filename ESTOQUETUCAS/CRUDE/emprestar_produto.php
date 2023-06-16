<?php
require('../conn.php');

// Verificar se a sessão foi iniciada
session_start();

$vista_pR = $_POST['vista_pR'];
$id_produtoR = $_POST['id_produtoRemprestar'];
$situacao_produtoR = $_POST['situacao_produtoR'];

$nomeProduto = $pdo->prepare("SELECT nome_produtoR FROM produtosretornaveis WHERE id_produtoR = :id_produtoR");
$nomeProduto->bindValue(':id_produtoR', $id_produtoR, PDO::PARAM_INT);
$nomeProduto->execute();
$nomeDoProdutoFinal = $nomeProduto->fetchColumn();

$prtProduto = $pdo->prepare("SELECT patrimonio FROM produtosretornaveis WHERE id_produtoR = :id_produtoR");
$prtProduto->bindValue(':id_produtoR', $id_produtoR, PDO::PARAM_INT);
$prtProduto->execute();
$prtDoProdutoFinal = $prtProduto->fetchColumn();

require("../protected.php");

if (isset($_SESSION['id'])) {
    $usuarioLogadoId = $_SESSION['id'];
} else {
    echo 'Não foi';
}

$sqlPerfilLogin = "SELECT login FROM usuarios WHERE id = :usuarioLogadoId";
$resultPerfilLogin = $pdo->prepare($sqlPerfilLogin);
$resultPerfilLogin->execute(array(':usuarioLogadoId' => $usuarioLogadoId));
$resultado = $resultPerfilLogin->fetch();
$nome_usuario_logado = $resultado['login'];

$cad_HISTORICOEMPR = $pdo->prepare("INSERT INTO empr_pr (mutuario_empr, produto_empr, patrimonio, responsavel) 
VALUES (:vista_pR, :nomeProdutoFinal, :patrimonio, :responsavel)");
$cad_HISTORICOEMPR->execute(array(
    ':vista_pR' => $vista_pR,
    ':nomeProdutoFinal' => $nomeDoProdutoFinal,
    ':patrimonio' => $prtDoProdutoFinal,
    ':responsavel' => $nome_usuario_logado
));

$emprestar_produto = $pdo->prepare("UPDATE produtosretornaveis SET vista_pR = 
:vista_pR, situacao_produtoR = 1 WHERE id_produtoR = :id_produtoR");
    
$emprestar_produto->execute(array(
    ':vista_pR' => $vista_pR,
    ':id_produtoR' => $id_produtoR,
));

header("Location: ../tabelasPR.php");
exit;
?>
