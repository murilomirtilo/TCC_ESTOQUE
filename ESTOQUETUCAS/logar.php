<?php
include("conn.php");
$login = $_POST['login1'];
$senha = $_POST['senha1'];

$usuario = $pdo->prepare('SELECT * FROM usuarios where login=:login AND senha=:senha');
$usuario->execute(array(':login'=>$login, ':senha'=>$senha));

$rowTabela = $usuario->fetchAll();

if (empty($rowTabela)){
    echo "<script>
    alert('Usuário e/ou senha inválidos!!!');
    </script>";
    
} else {
    $sessao = $rowTabela[0];

    if (!isset($_SESSION)) {
        session_start();    
    }
    $_SESSION['id'] = $sessao['id'];
    $_SESSION['login'] = $sessao['login'];
    $usuarioLogadoId = $_SESSION['id']; // Armazena o ID do usuário logado na variável $usuarioLogadoId
    header("Location: tabelas.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Usuário ou senha incorretas</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="styleError.css" />



</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404"></div>
			<h1>Error</h1>
			<h2>Oops! Seu usuário/ senha não foram encontrados</h2>
			<p>Você tem certeza de que está inseriu as informações corretas? Não encontramos ela no banco de dados.</p>
			<a href="telaCadastroeLogin.php">Voltar para tela de cadastro/login</a>
		</div>
	</div>

</body>

</html>
