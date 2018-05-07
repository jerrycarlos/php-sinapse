<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){	
	ini_set('default_charset', 'UTF-8');
	include "./config/defineDB.php";
require ("./config/conectaBanco.class.php");
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);				
		$tema = $data["tema"];
		$descricao = $data["descricao"];
		$instituicao = $data["fk_instituicao"];
		$palestrante = $data["fk_palestrante"];
		$sql = "SELECT * from evento where fk_palestrante = '$palestrante' and tema = '$tema' and fk_instituicao = '$instituicao'";
		$consulta = $banco->executa($sql);		
		if(mysqli_num_rows ($consulta) <= 0){			
			$sql = "INSERT INTO evento (id,tema,descricao,fk_instituicao,fk_palestrante) VALUES(default,'$tema','$descricao','$instituicao','$palestrante')";
			$result = $banco->executa($sql);		
			if($result){		
				$json = array("status" => 1, "msg" => "Evento cadastrado com sucesso!");				
			}else{
				$json = array("status" => 0, "msg" => "Evento não pôde ser cadastrado!");
			}
		}else $json = array("status" => 0, "msg" => "Você já possui um evento cadastrado com estes dados.");
		$banco->close();
}else{
// Insert data into data base
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);
?>