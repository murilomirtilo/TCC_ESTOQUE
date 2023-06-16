<?php
    require('../conn.php');

   if( isset($_GET['produtoR'])){
        $produtoR = $_GET['produtoR'];
   }else{
        header("Location: ../tabelasPR.php");
   }

   $del_prodR = $pdo->prepare('DELETE FROM produtosretornaveis WHERE id_produtoR=:produtoR');
   $del_prodR->execute(array(':produtoR'=>$produtoR)); 
   header("Location: ../tabelasPR.php"); 
?>