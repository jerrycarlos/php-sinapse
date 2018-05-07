<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	require "./config/defineDB.php";
	require "./config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
		$json = array();					
		$sql = "SELECT id,nome_fantasia from instituicoes order by id";				
		$consulta = $banco->executa($sql);			
		if(mysqli_num_rows ($consulta) > 0){				
			while($registro = mysqli_fetch_assoc($consulta)){										
				array_push($json, array('id'=>$registro['id'],'nome'=>$registro['nome_fantasia']));
			}				
		}else $json = array("erro" => -1, "msg" => "Nenhuma instituição cadastrada!");	
}else{
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);
 ?>