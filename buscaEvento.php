<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	require "./config/defineDB.php";
	require "./config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);						
		$json = array();					
		$sql = "SELECT e.id, e.tema, e.descricao, e.fk_palestrante, e.fk_instituicao, u.nome, i.nome_fantasia from evento e inner join usuario u on u.id = e.fk_palestrante inner join instituicoes i on i.id = e.fk_instituicao";			
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){				
				while($registro = mysqli_fetch_assoc($consulta)){
					array_push($json, array('id'=>$registro['id'],'tema'=>$registro['tema'],'descricao'=>$registro['descricao'],'local'=>$registro['nome_fantasia'],'palestrante'=>$registro['nome'],'fk_palestrante'=>$registro['fk_palestrante'],'fk_instituicao'=>$registro['fk_instituicao']));				
					}											
		}else $json = array("erro" => -1, "msg" => "Nenhum evento cadastrado!");
}else{
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);
 ?>