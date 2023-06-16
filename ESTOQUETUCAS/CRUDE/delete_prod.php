<?php
require('../conn.php');
require("../protected.php");

if (isset($_SESSION['id'])) {
    $usuarioLogadoId = $_SESSION['id'];
} else {
    echo('Não foi');
}

$id_prod = $_POST['id_prod'];
$causa_baixa = $_POST['causa_baixa'];

$produto = $id_prod;

$nome_prod = $pdo->prepare('SELECT nome_produto FROM produtos WHERE id_produto = ?');
$nome_prod->execute(array($id_prod));
$result = $nome_prod->fetch();
$nome_produto = $result['nome_produto'];

$sqlPerfilLogin = "SELECT login FROM usuarios WHERE id = $usuarioLogadoId";
$resultPerfilLogin = $pdo->query($sqlPerfilLogin);
$resultado = $resultPerfilLogin->fetch();
$nome_usuario_logado = $resultado['login'];



$cad_baixa = $pdo->prepare("INSERT INTO baixas (causa_baixa, nome_baixa, responsavel) 
VALUES (:causa_baixa, :nome_baixa, :responsavel)");
$cad_baixa->execute(array(
    ':causa_baixa' => $causa_baixa,
    ':nome_baixa' => $nome_produto,
    ':responsavel' => $nome_usuario_logado
));
 $del_prod = $pdo->prepare('DELETE FROM produtos WHERE id_produto = ?');
 $del_prod->execute(array($id_prod));

 header("Location: ../tabelas.php"); 
?>
