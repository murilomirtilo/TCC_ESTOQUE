<?php
    require('conn.php');

    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
   
    if(empty($login) || empty($email) || empty($senha)){
        echo "Os valores não podem ser vazios";
    }else{
        $cad_user = $pdo->prepare("INSERT INTO usuarios(login, email, senha) 
        VALUES(:login, :email, :senha)");
        $cad_user->execute(array(
            ':login'=> $login,
            ':email'=> $email,
            ':senha'=> $senha  
        ));



        header("Location: telaCadastroelogin.php");
        exit();
    }
?>