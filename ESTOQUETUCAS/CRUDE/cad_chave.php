<?php
    require('../conn.php');

    $nome_chave = $_POST['nome_chave'];

   
    if(empty($nome_chave)){
        echo "Os valores não podem ser vazios";
    }else{
        $cad_chave = $pdo->prepare("INSERT INTO chaves(nome_chave) 
        VALUES(:nome_chave)");
        $cad_chave->execute(array(
            ':nome_chave'=> $nome_chave
        ));

        echo "<script>
        alert('Chave Cadastrado com sucesso!');
        </script>";
        header("Location: ../tabelasChave.php");
    }
?> 