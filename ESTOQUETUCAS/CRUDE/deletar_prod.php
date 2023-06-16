<?php
    require('../conn.php');

   if( isset($_GET['produto'])){
        $produto = $_GET['produto'];
   }else{
        header("Location: ../tabelas.php");
   }

   $del_prod = $pdo->prepare('DELETE FROM produtos WHERE id_produto=:produto');
   $del_prod->execute(array(':produto'=>$produto)); 
   header("Location: ../tabelas.php"); 
?>