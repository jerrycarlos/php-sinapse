<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){	
	include "../config/defineDB.php";
require ("../config/conectaBanco.class.php");
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);		
		$idUser = $data["user"];
		$idEvento = $data["evento"];
		$sql = "SELECT id from evento where fk_palestrante = '$idUser' and id = '$idEvento'";
		$consulta = $banco->executa($sql);
		if(mysqli_num_rows($consulta) <= 0){
			$sql = "SELECT id from evento_participante where fk_participante = '$idUser' and fk_evento = '$idEvento'";
			$consulta = $banco->executa($sql);		
			if(mysqli_num_rows ($consulta) <= 0){				
				$sql = "INSERT INTO evento_participante (id,fk_evento,fk_participante) values (default,'$idEvento','$idUser')";
				$result = $banco->executa($sql);		
				if($result){		
					$json = array("status" => 1, "msg" => "Você foi cadastro neste evento!");				
				}else{
					$json = array("status" => 0, "msg" => "Usuário não podê ser cadastrado neste evento!");
				}
			}else $json = array("status" => 0, "msg" => "Você já está cadastrado nesse evento!");
		}else $json = array("status" => 0, "msg" => "Você já é palestrante do evento!");
		$banco->close();
}else{
// Insert data into data base
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);

 ?>