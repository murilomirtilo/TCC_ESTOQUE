<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_baixaPR, avaria_produtoR, data_PR, nome_PR, patrimonio, responsavel FROM baixa_pr");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "ID Produto\tAvaria Produto\tData PR\tNome PR\tPatrimônio\tResponsável\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $idProduto = $linha['id_baixaPR'];
        $avariaProduto = $linha['avaria_produtoR'];
        $dataPR = $linha['data_PR'];
        $nomePR = $linha['nome_PR'];
        $patrimonio = $linha['patrimonio'];
        $responsavel = $linha['responsavel'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-12s\t%-16s\t%-10s\t%-10s\t%-10s\t%-12s\n", $idProduto, $avariaProduto, $dataPR, $nomePR, $patrimonio, $responsavel);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'Baixas-PR' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
