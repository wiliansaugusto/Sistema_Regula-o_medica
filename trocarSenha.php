<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="../jquery/jquery.min.js"></script>
      
	<title>Trocar senha usuário</title>
	<script type="text/javascript">
		function changePassword(){
			document.getElementById("div_id").style.display = "none";
			document.getElementById("div_new_password").style.display = "inline";
		}
	</script>
</head>
<?php require_once "navbar.php"; ?>

<body style="text-align: center;">
	<h3>Trocar Senha Usuário</h3>
	<div id="div_id" class="container">
		<form method="POST" action="trocarSenha.php">
			<label for="">insira seu registro</label>
			<input type="number"  name="reg" id="reg" placeholder="Insira seu Numero de Registro!">
			<input type="submit" name="btn_id">
		</form>
	</div>
	<br>
	<div id="div_new_password" style="display: none;">
	<?php echo("ola: ". $_SESSION['nomeProfisional'])?>

		<form method="POST" action="trocarSenha.php">
			<label for="">insira a nova senha</label>
			<input type="password" name="new_password" placeholder="Insira nova senha!">
			<input type="submit" name="btn_new_password">
		</form>
	</div>

	<?php 
require('conexao.php'); # Conexão com o Banco de Dados.
if(isset($_POST["btn_id"])){  # Verifica se o botão de trocar senha foi acionado. 
	
	$reg = $_POST['reg']; # Recebendo o ID inserido pelo usuário.
	$_SESSION['reg']= $reg;
	$sql = "SELECT * FROM tb_profissional WHERE nr_registro_funcional = $reg"; # Select feito para verificar se existe a pessoa no banco de dados. 
	$result = $conn->query($sql); # Executar o select. 
	$results = $result->fetch_assoc(); # Colocando valores do select em um array associativo.
	$_SESSION['nomeProfisional'] = $results['nm_profissional'];
	if(isset($results['nm_profissional'])) # Verifica se existe a pessoa no banco e se o select trouxe mesmo. 
		echo "<script>changePassword();</script>"; # Chama a função JavaScript para mudar a div de troca senha pra visible.
	
}

if(isset($_POST["new_password"])){  # Verifica se o botão de trocar senha foi acionado. 
	$reg = $_SESSION['reg'];
	$password = $_POST['new_password']; # Recebendo o ID inserido pelo usuário.
	$sqlsenha = "UPDATE tb_profissional SET ds_senha ='$password' WHERE nr_registro_funcional = $reg "; # Select feito para verificar se existe a pessoa no banco de dados. 
	$result = $conn->query($sqlsenha); # Executar o update. 
	echo($_SESSION['nomeProfisional']."<br>"."sua nova senha é: ".$password);
	//	$results = $result->fetch_assoc(); # Colocando valores do select em um array associativo.

	
}


?>
</body>
<?php require_once "footer.php"; ?>

</html>

