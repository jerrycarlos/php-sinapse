<?php
//ini_set('display_errors', true);
//error_reporting(E_ALL);
//require "./config/conectaBanco.class.php";
include "./config/defineDB.php";
require ("./config/conectaBanco.class.php");
if($_SERVER['REQUEST_METHOD'] == "POST"){	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);
	$data = json_decode(file_get_contents('php://input'), true);
		$nome = $data["name"];
		$email = $data["email"];
		$senha = $data["senha"];
	if(isset($data["name"]) && isset($data["email"]) && isset($data["senha"])){
		$sql = "insert into usuario values(default,'$nome','$email','$senha')";
		$result = $banco->executa($sql);		
		if($result){		
			$json = array("status" => 1, "msg" => "Usuario cadastrado!");	
		}else{
			$json = array("status" => 0, "msg" => "Usuário não podê ser cadastrado!");
		}
	}
}else{
// Insert data into data base
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);

 ?>

 		<!-- $st = mysqli_prepare($connection, 'INSERT INTO usuario(nome, email, senha) VALUES (?, ?, ?)');

    // bind variables to insert query params
    mysqli_stmt_bind_param($st, 'sss', $daat['name'], $data['email'], $data['senha']);

    // executing insert query
    mysqli_stmt_execute($st); -->
