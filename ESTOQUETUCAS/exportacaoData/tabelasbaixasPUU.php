<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_baixa, causa_baixa, data_baixa, nome_baixa, responsavel FROM baixas");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "ID Baixa\tCausa Baixa\tData Baixa\tNome Baixa\tResponsável\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $idBaixa = $linha['id_baixa'];
        $causaBaixa = $linha['causa_baixa'];
        $dataBaixa = $linha['data_baixa'];
        $nomeBaixa = $linha['nome_baixa'];
        $responsavel = $linha['responsavel'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-8s\t%-12s\t%-10s\t%-10s\t%-12s\n", $idBaixa, $causaBaixa, $dataBaixa, $nomeBaixa, $responsavel);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'Baixas-PUU' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
