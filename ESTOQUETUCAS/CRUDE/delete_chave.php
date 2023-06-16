<?php
    require('../conn.php');

   if( isset($_GET['produto'])){
        $produto = $_GET['produto'];
   }else{
        header("Location: ../tabelaschave.php");
   }

   $del_chave = $pdo->prepare('DELETE FROM chaves WHERE id_chave=:produto');
   $del_chave->execute(array(':produto'=>$produto)); 
   header("Location: ../tabelaschave.php"); 
?>