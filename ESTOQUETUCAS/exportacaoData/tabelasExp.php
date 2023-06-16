<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_produto, nome_produto, qtd_produto, valor_produto, cat_produto, unidade_produto 
    FROM produtos;");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "Nome\tQuantidade\tUnidade\tLocal\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $mutuario = $linha['nome_produto'];
        $quantidade = $linha['qtd_produto'];
        $unidade = $linha['unidade_produto'];
        $local = $linha['valor_produto'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-20s\t%-20s\t%-10s\t%-10s\n", $mutuario, $quantidade, $unidade, $local);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'TabelasProdutos-PUU' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
