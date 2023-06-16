<?php
    require('../conn.php');

    $id_prod = $_POST['edit_id_produto'];
    $name_prod = $_POST['edit_nome_produto'];
    $qtd_prod = $_POST['edit_qtd_produto'];
    $valor_prod = $_POST['edit_valor_produto'];
    $cat_prod = $_POST['edit_cat_produto'];

    if(empty($name_prod) || empty($qtd_prod) || empty($valor_prod) || empty($cat_prod) || empty($id_prod)){
        echo "Os valores não podem ser vazios";
    }else{
        $update_prod = $pdo->prepare("UPDATE produtos set 
        nome_produto = :name_prod, 
        qtd_produto = :qtd_prod, 
        valor_produto = :valor_prod, 
        cat_produto = :cat_prod WHERE 
        id_produto = :id_prod;");
    

    $update_prod->execute(array(
        ':id_prod' => $id_prod,
        ':name_prod'=> $name_prod,
        ':qtd_prod'=> $qtd_prod,
        ':valor_prod'=> $valor_prod,
         ':cat_prod'=> $cat_prod  
    ));


    header("Location: ../tabelas.php");
    echo 'sucesso';
    }

?>
