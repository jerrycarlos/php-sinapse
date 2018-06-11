<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	require "../config/defineDB.php";
	require "../config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);		
	$idEvento = $data["idEvento"];						
		$json = array();					
		$sql = "SELECT u.nome, u.instituicao, u.curso from usuario u inner join evento_participante ep on u.id = ep.fk_participante inner join evento e on e.id = ep.fk_evento where e.id = '$idEvento'";			
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){				
				while($registro = mysqli_fetch_assoc($consulta)){
					array_push($json, array('nome'=>$registro['nome'],'instituicao'=>$registro['instituicao'],'curso'=>$registro['curso']));				
				}											
		}else $json = array("erro" => -1, "msg" => "Nenhum participante cadastrado nesse evento!");
}else{
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);
 ?>