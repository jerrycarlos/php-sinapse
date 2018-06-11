<?php
	require "../config/defineDB.php";
	require "../config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);				
	$json = array();					
	$sql = "SELECT tokenId from usuario where tokenId IS NOT NULL";			
	$consulta = $banco->executa($sql);	
	if(mysqli_num_rows ($consulta) > 0){				
		while($registro = mysqli_fetch_assoc($consulta)){
			array_push($json, $registro['tokenId']);				
		}	
	}	
?>