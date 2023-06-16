<?php
    require('../conn.php');

    $name_prod = $_POST['name_prod'];
    $patrimonio = $_POST['patr_prod'];
    $local_prod = $_POST['local_prod'];

    if (empty($name_prod) || empty($local_prod)) {
        echo "Os valores não podem ser vazios";
    } else {
        // Verificar se o patrimônio já existe no banco de dados
        $verificar_patrimonio = $pdo->prepare("SELECT COUNT(*) FROM produtosretornaveis WHERE patrimonio = :patrimonio");
        $verificar_patrimonio->execute(array(':patrimonio' => $patrimonio));
        $existe_patrimonio = $verificar_patrimonio->fetchColumn();

        $verificar_patrimonioBa = $pdo->prepare("SELECT COUNT(*) FROM baixa_pr WHERE patrimonio = :patrimonio");
        $verificar_patrimonioBa->execute(array(':patrimonio' => $patrimonio));
        $existe_patrimonioBa = $verificar_patrimonioBa->fetchColumn();
        
        if ($existe_patrimonio > 0 || $existe_patrimonioBa > 0) {
            // Patrimônio já existe, mostrar mensagem de erro
            echo "<script>
                alert('O patrimônio informado já existe!');
                window.history.back();
            </script>";
        } else {
            // Patrimônio não existe, realizar a inserção do produto
            $cad_prod = $pdo->prepare("INSERT INTO produtosretornaveis(nome_produtoR, local_produtoR, patrimonio) 
            VALUES(:name_produtoR, :local_produtoR, :patrimonio)");
            $cad_prod->execute(array(
                ':name_produtoR' => $name_prod,
                ':local_produtoR' => $local_prod,
                ':patrimonio' => $patrimonio
            ));

            echo "<script>
            window.location.href = '../tabelasPR.php';
            </script>";
        }
    }
?>