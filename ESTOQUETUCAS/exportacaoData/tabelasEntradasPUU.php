<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_entrada, quantidade_entrada, nome_entrada, data_entrada, unidade_entrada, user_entrada, quantidadeAnterior_entrada FROM entrada");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "ID Entrada\tQuantidade\tQuantidade Anterior\tNome\tData\tUnidade\tUsuário\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $idEntrada = $linha['id_entrada'];
        $quantidadeEntrada = $linha['quantidade_entrada'];
        $nomeEntrada = $linha['nome_entrada'];
        $dataEntrada = $linha['data_entrada'];
        $unidadeEntrada = $linha['unidade_entrada'];
        $userEntrada = $linha['user_entrada'];
        $quantidadeAnterior = $linha['quantidadeAnterior_entrada'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-10s\t%-10s\t%-12s\t%-10s\t%-8s\t%-10s\t%-18s\n", $idEntrada, $quantidadeEntrada, $quantidadeAnterior, $nomeEntrada, $dataEntrada, $unidadeEntrada, $userEntrada);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'TabelaEntrada-PUU' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
