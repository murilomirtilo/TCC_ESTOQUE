<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    echo '
    <link rel="shortcut icon" href="imagens/tucano.png" type="image/png">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
        <title>Usuário sem permissão</title>
    
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
    
        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="styleError.css" />
    
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    
    </head>
    
    <body>
    
        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404"></div>
                <h1>Acesso negado</h1>
                <h2>Usuário não logado</h2>
                <p>Você precisa estar logado para poder acessar o sistema!</p>
                <a href="telaCadastroeLogin.php">Ir para a tela de login/cadastro</a>
            </div>
        </div>
    
    </body>
    </html>';
    die;
}
?>