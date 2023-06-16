<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_emprPR, mutuario_empr, data_empr, produto_empr, patrimonio, responsavel FROM empr_pr");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "ID Empréstimo\tMutuário\tData Empréstimo\tProduto\tPatrimônio\tResponsável\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $idEmprestimo = $linha['id_emprPR'];
        $mutuario = $linha['mutuario_empr'];
        $dataEmprestimo = $linha['data_empr'];
        $produto = $linha['produto_empr'];
        $patrimonio = $linha['patrimonio'];
        $responsavel = $linha['responsavel'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-14s\t%-8s\t%-16s\t%-8s\t%-10s\t%-12s\n", $idEmprestimo, $mutuario, $dataEmprestimo, $produto, $patrimonio, $responsavel);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'TabelaEmpréstimos-PR' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
