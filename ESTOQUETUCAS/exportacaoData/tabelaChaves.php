<?php
    require("../conn.php");
    require("../protected.php");
    $tabela = $pdo->prepare("SELECT id_chave, nome_chave, data_chave, disponivel_chave, responsavel FROM chaves");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    // Cria uma string para armazenar os dados da tabela
    $txtData = "ID Chave\tNome Chave\tData Chave\tDisponível\tResponsável\n";

    // Percorre os dados da tabela
    foreach ($rowTabela as $linha) {
        $idChave = $linha['id_chave'];
        $nomeChave = $linha['nome_chave'];
        $dataChave = $linha['data_chave'];
        $disponivelChave = $linha['disponivel_chave'];
        $responsavel = $linha['responsavel'];

        // Concatena os dados na string formatados em colunas
        $txtData .= sprintf("%-8s\t%-12s\t%-10s\t%-10s\t%-12s\n", $idChave, $nomeChave, $dataChave, $disponivelChave, $responsavel);
    }

    // Define o nome do arquivo com a data de download
    $fileName = 'TabelaChaves' . date('Y-m-d') . '.txt';

    // Define os cabeçalhos para download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    // Envia os dados para o navegador
    echo $txtData;
    exit;
?>
