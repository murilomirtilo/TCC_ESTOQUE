<?php
    require('../conn.php');

    $qtd_prodForm = $_POST['qtd_prod'];
    $id_prod = $_POST['id_prod_empr'];
    $mutuario_empr = $_POST['mutuario_empr'];


    $getProdutoNome = $pdo->prepare("SELECT nome_produto FROM produtos WHERE id_produto = :id");
    $getProdutoNome->bindValue(':id', $id_prod, PDO::PARAM_INT);
    $getProdutoNome->execute();
    $produtoEMPR = $getProdutoNome->fetch(PDO::FETCH_ASSOC); 
    $produto_empr = $produtoEMPR['nome_produto']; 

    $getProdutoQtd = $pdo->prepare("SELECT qtd_produto FROM produtos WHERE id_produto = $id_prod;");
    $getProdutoQtd->execute();
    $NumeroPara = $getProdutoQtd->fetch(PDO::FETCH_ASSOC);
    $antigoNumero = $NumeroPara['qtd_produto'];
    $qtd_novaprodForm = $antigoNumero - $qtd_prodForm;
    

    require("../protected.php");

    if (isset($_SESSION['id'])) {
        $usuarioLogadoId = $_SESSION['id'];
    } else {
        echo('Não foi');
    }
    
    $sqlPerfilLogin = "SELECT login FROM usuarios WHERE id = :usuarioLogadoId";
    $resultPerfilLogin = $pdo->prepare($sqlPerfilLogin);
    $resultPerfilLogin->execute(array(':usuarioLogadoId' => $usuarioLogadoId));
    $resultado = $resultPerfilLogin->fetch();
    $nome_usuario_logado = $resultado['login'];
    
    
    $getProdutoUnidade = $pdo->prepare("SELECT unidade_produto FROM produtos WHERE id_produto = :id");
    $getProdutoUnidade->bindValue(':id', $id_prod, PDO::PARAM_INT);
    $getProdutoUnidade->execute();
    $produtoEMPRUnidade = $getProdutoUnidade->fetch(PDO::FETCH_ASSOC); 
    $produto_unidade = $produtoEMPRUnidade['unidade_produto']; 

    if(empty($qtd_prodForm) || (empty($mutuario_empr))){
        echo "Os valores não podem ser vazios";
    }elseif($antigoNumero < $qtd_prodForm) {
        echo("Você não pode remover o que não tem");
    }else{

        #$newQuantidadeProd = $sqlMatematica - $qtd_prod;

        $update_prod = $pdo->prepare("UPDATE produtos set 
            qtd_produto = :qtd_prod WHERE 
            id_produto = :id_prod;");
    
        $update_prod->execute(array(
            ':qtd_prod'=> $qtd_novaprodForm,
            ':id_prod'=> $id_prod));

            $lancar_empr = $pdo->prepare("INSERT INTO emprestimos (mutuario_empr, quantidade_empr, data_empr, produto_empr, responsavel, unidade_empr) 
            VALUES (:mutuario_empr, :quantidade_empr, :data_empr, :produto_empr, :responsavel, :unidade_empr)");
            
            $lancar_empr->execute(array(
                ':mutuario_empr'=> $mutuario_empr,
                ':quantidade_empr'=> $qtd_prodForm,
                ':data_empr'=> date('Y-m-d H:i:s'),
                ':produto_empr'=> $produto_empr,
                ':responsavel' => $nome_usuario_logado,
                ':unidade_empr' => $produto_unidade
            ));

    header("Location: ../tabelas.php");
    }

?>
