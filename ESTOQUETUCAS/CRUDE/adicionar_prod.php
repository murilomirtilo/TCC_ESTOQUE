<?php
    require('../conn.php');

    $id_prod = $_POST['id_prod_add'];
    $qtd_prod_add = $_POST['qtd_prod_add'];


    require("../protected.php");

    if (isset($_SESSION['id'])) {
        $usuarioLogadoId = $_SESSION['id'];
    } else {
        echo('Não foi');
    }
    if(empty($qtd_prod_add)){
        echo "Os valores não podem ser vazios";
    }else{
    $sqlPerfilLogin = "SELECT login FROM usuarios WHERE id = :usuarioLogadoId";
    $resultPerfilLogin = $pdo->prepare($sqlPerfilLogin);
    $resultPerfilLogin->execute(array(':usuarioLogadoId' => $usuarioLogadoId));
    $resultado = $resultPerfilLogin->fetch();
    $nome_usuario_logado = $resultado['login'];

    $getProdutoNome = $pdo->prepare("SELECT nome_produto FROM produtos WHERE id_produto = $id_prod;");
    $getProdutoNome->execute();
    $NomePrd = $getProdutoNome->fetch(PDO::FETCH_ASSOC);
    $nomeDoProdutoFinal = $NomePrd['nome_produto'];

    $getProdutoUnidade = $pdo->prepare("SELECT unidade_produto FROM produtos WHERE id_produto = $id_prod;");
    $getProdutoUnidade->execute();
    $NomeUnidade = $getProdutoUnidade->fetch(PDO::FETCH_ASSOC);
    $unidade_entradaA = $NomeUnidade['unidade_produto'];

    $getProdutoQtd = $pdo->prepare("SELECT qtd_produto FROM produtos WHERE id_produto = $id_prod;");
    $getProdutoQtd->execute();
    $NumeroPara = $getProdutoQtd->fetch(PDO::FETCH_ASSOC);
    $antigoNumero = $NumeroPara['qtd_produto'];
    $qtd_novaprodForm = $antigoNumero + $qtd_prod_add;


    $cad_HISTORICOADD = $pdo->prepare("INSERT INTO entrada (quantidade_entrada, nome_entrada, user_entrada, unidade_entrada, quantidadeAnterior_entrada) 
    VALUES (:quantidade_entrada, :nome_entrada, :user_entrada, :unidade_entrada, :quantidadeAnterior_entrada)");
    $cad_HISTORICOADD->execute(array(
        ':quantidade_entrada' => $qtd_prod_add,
        ':nome_entrada' => $nomeDoProdutoFinal,
        ':user_entrada' => $nome_usuario_logado,
        ':unidade_entrada' => $unidade_entradaA,
        ':quantidadeAnterior_entrada' => $antigoNumero
    ));


    $atualizarQTD = $pdo->prepare("UPDATE produtos SET qtd_produto = :qtd_produto WHERE id_produto = :id_produto");
    $atualizarQTD->execute(array(
        ':id_produto' => $id_prod,
        ':qtd_produto' => $qtd_novaprodForm
    ));

    header("Location: ../tabelas.php");
}
?>



