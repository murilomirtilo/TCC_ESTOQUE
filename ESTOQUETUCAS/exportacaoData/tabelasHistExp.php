<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_empr, mutuario_empr, quantidade_empr, data_empr, produto_empr, responsavel, unidade_empr
    FROM emprestimos;");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "ID\tMutuário\tQuantidade\tData\tProduto\tResponsável\tUnidade\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $id = $linha['id_empr'];
        $mutuario = $linha['mutuario_empr'];
        $quantidade = $linha['quantidade_empr'];
        $data = $linha['data_empr'];
        $produto = $linha['produto_empr'];
        $responsavel = $linha['responsavel'];
        $unidade = $linha['unidade_empr'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-10s\t%-20s\t%-10s\t%-10s\t%-20s\t%-20s\t%-10s\n", $id, $mutuario, $quantidade, $data, $produto, $responsavel, $unidade);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'HistoricoRetirada-PUU' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
