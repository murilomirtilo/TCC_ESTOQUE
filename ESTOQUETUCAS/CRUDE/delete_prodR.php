<?php
require('../conn.php');


$id_produtoR = $_POST['id_produtoR'];
$avaria_produtoR = $_POST['avaria_produtoR'];

$produto = $id_produtoR;

$nome_prod = $pdo->prepare('SELECT nome_produtoR FROM produtosretornaveis WHERE id_produtoR = :id_produtoR');
$nome_prod->execute(array(':id_produtoR' => $id_produtoR));
$result = $nome_prod->fetch();
$nome_produtoR = $result['nome_produtoR'];

$prtProduto = $pdo->prepare("SELECT patrimonio FROM produtosretornaveis WHERE id_produtoR = :id_produtoR");
$prtProduto->bindValue(':id_produtoR', $id_produtoR, PDO::PARAM_INT);
$prtProduto->execute();
$prtDoProdutoFinal = $prtProduto->fetchColumn();

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

$cad_baixa = $pdo->prepare("INSERT INTO baixa_pr (avaria_produtoR, nome_PR, patrimonio, responsavel) VALUES (:avaria_produtoR, :nome_produtoR, :patrimonio, :responsavel)");
$cad_baixa->execute(array(
    ':avaria_produtoR' => $avaria_produtoR,
    ':nome_produtoR' => $nome_produtoR,
    ':patrimonio' => $prtDoProdutoFinal,
    ':responsavel' => $nome_usuario_logado
));

$del_prod = $pdo->prepare('DELETE FROM produtosretornaveis WHERE id_produtoR = :id_produtoR');
$del_prod->execute(array(':id_produtoR' => $id_produtoR));

header("Location: ../tabelasPR.php");
?>
