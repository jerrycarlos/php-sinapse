<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	require "../config/defineDB.php";
	require "../config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);		
	$email = $data["email"];					
	$senha = $data["senha"];

		//$json = Array();					
		$sql = "SELECT id from usuario where email = '$email' or login = '$email'";			
		$consulta = $banco->executa($sql);		
		if(mysqli_num_rows ($consulta) > 0){
			$sql = "SELECT * from usuario where (email = '$email' or login = '$email') and senha = '$senha'";
			$consulta = $banco->executa($sql);
			if(mysqli_num_rows ($consulta) > 0){				
				$registro = mysqli_fetch_assoc($consulta);
					//$json[] = $registro;

				$id = $registro['id'];
				$sql = "SELECT imagem from perfil where fk_user = $id";
				$imagem = $banco->executa($sql);
				$img = mysqli_fetch_assoc($imagem);
					$json = array("id"=>$registro['id'],"nome"=>$registro['nome'],"email"=>$registro['email'],"senha" =>$registro['senha'],"login"=>$registro['login'],"telefone"=>$registro['telefone'],"instituicao"=>$registro['instituicao'],"curso"=>$registro['curso'],"periodo"=>$registro['periodo'],"ocupacao"=>$registro['ocupacao'],"imagem"=>$img['imagem'],"status"=>1,"msg"=>"Logado com sucesso");							
			}else $json = array("status" => -1, "msg" => "Senha incorreta!");
		}else $json = array("status" => -1, "msg" => "Credencial não cadastrada!");
}else{
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);
 ?>