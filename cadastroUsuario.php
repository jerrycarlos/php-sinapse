<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
ini_set('default_charset', 'UTF-8');	
	include "./config/defineDB.php";
require ("./config/conectaBanco.class.php");
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);		
		$email = $data["email"];
		$nome = $data["nome"];
		$login = $data["login"];		
		$senha = $data["senha"];	
		$telefone = $data["telefone"];
		$inst = $data["instituicao"];
		$curso = $data["curso"];
		$periodo = $data["periodo"];
		$ocupacao = $data["ocupacao"];
		$strErro = "";
		$erro = 0;		
		$sql = "SELECT id from usuario where (email = '$email')";		
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){				
			$erro++;
			$strErro = $strErro."[ Email";
			
		}

		$sql = "SELECT id from usuario where (login = '$login')";		
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){
			if($erro > 0)
				$strErro = $strErro.", login";
			else $strErro = "[ Login";				
			$erro++;			
		}

		$sql = "SELECT id from usuario where (telefone = '$telefone')";		
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){	
			if($erro > 0){
				$erro++;
				$strErro = $strErro.", telefone";
			}
			else {
				$erro = 1;
				$strErro = "[Telefone";								
			}
		}		

		if($erro == 0){		
			$sql = "INSERT INTO usuario (id,nome,email,senha,login,telefone,instituicao,curso,periodo,ocupacao) VALUES(default,'$nome','$email','$senha','$login','$telefone','$inst','$curso','$periodo','$ocupacao')";
			$result = $banco->executa($sql);		
			if($result){		
				$sql = "SELECT * from usuario where email = '$email'";
				$consulta = $banco->executa($sql);
				while($registro = mysqli_fetch_assoc($consulta)){
					//$json[] = $registro;
					$json = array("id" => $registro['id'],"nome" => $registro['nome'],"email" => $registro['email'],"senha" => $registro['senha'],"login" => $registro['login'],"telefone" => $registro['telefone'],"instituicao" => $registro['instituicao'],"curso"=>$registro['curso'],"periodo" => $registro['periodo'],"ocupacao" => $registro['ocupacao'],"status" => 1, "msg" => "Usuario cadastrado com sucesso!");

				}				
			}else{
				$json = array("status" => 0, "msg" => "Usuário não podê ser cadastrado!");
			}
		}else{
			if($erro < 2)
				$json = array("status" => 0, "msg" => $strErro." ] já utilizado.");
			else
				$json = array("status" => 0, "msg" => $strErro." ] já utilizados");			
		}
		$banco->close();
}else{
// Insert data into data base
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);

 ?>