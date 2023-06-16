<?php
    require('../conn.php');

    $name_prod = $_POST['name_prod'];
    $qtd_prod = $_POST['qtd_prod'];
    $valor_prod = $_POST['valor_prod'];
    $cat_prod = $_POST['cat_prod'];
    $unidade_produto = $_POST['unidade_produto'];

    if (empty($name_prod) || empty($qtd_prod) || empty($unidade_produto) || empty($valor_prod)) {
        echo "Os valores não podem ser vazios";
    } else {
        $cad_prod = $pdo->prepare("INSERT INTO produtos(nome_produto, qtd_produto, valor_produto, cat_produto, unidade_produto) 
        VALUES(:name_prod, :qtd_prod, :valor_prod, :cat_prod, :unidade_produto)");
        $cad_prod->execute(array(
            ':name_prod'=> $name_prod,
            ':qtd_prod'=> $qtd_prod,
            ':valor_prod'=> $valor_prod,
            ':cat_prod'=> $cat_prod,
            ':unidade_produto' => $unidade_produto
        ));

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            function exibirPopupCadastro(titulo, texto, icon, botao) {
                Swal.fire({
                    title: titulo,
                    text: texto,
                    icon: icon,
                    confirmButtonText: botao
                });
            }

            exibirPopupCadastro('Produto Cadastrado', 'Produto cadastrado com sucesso!', 'success', 'OK');
        </script>";
        header("Location: ../tabelas.php");
    }
?> 
