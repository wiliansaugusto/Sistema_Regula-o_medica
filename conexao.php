<?php
	$servidor = "localhost:8889";
	$usuario = "root";
	$senha = "root";
	$dbname = "id7124820_samu";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
	}	
	
?>