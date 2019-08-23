<?php include ('conexao.php'); 



if(empty($_POST['user']) || empty($_POST['pass'])) {
	header('Location: login.php');
	exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['user']);
$senha = mysqli_real_escape_string($conexao, $_POST['pass']);

//$query = "select usuario from usuario where login = '{$user}' and senha = md5('{$pass}')";
$query = "select usuarios from usuario where login = '{$user}' and senha = md5('{$pass}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['user'] = $usuario;
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: login.php');
	exit();
}

