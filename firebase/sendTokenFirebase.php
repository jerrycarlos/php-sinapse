<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){	
	ini_set('default_charset', 'UTF-8');
	require "../config/defineDB.php";
	require ("../config/conectaBanco.class.php");
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);				
		$tokenId = $data["token"];	
		$sql = "UPDATE FirebaseInstanceId set tokenId = '$tokenId'";
		$result = $banco->executa($sql);		
				
			if($result){		
				$json = array("codigo" => 1, "msg" => "Token atualizado com sucesso!");				
			}else{
				$json = array("codigo" => 0, "msg" => "Token não pôde ser atualizado!");
			}		
		$banco->close();
}else{
// Insert data into data base
	$json = array("codigo" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);
?>