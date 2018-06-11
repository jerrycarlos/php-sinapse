<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$json = array();					
	 $data = json_decode(file_get_contents('php://input'), true);
	 $img = $data["img"];	
	 if(isset($img)){
		$json = array("status" => 1, "msg" => salvarFoto($img));
	 }else{
		$json = array("status" => 0, "msg" => "Dados inválidos");
	 }
}else{
	$json = array("status" => 0, "msg" => "Metodo nao post!");
}
header('Content-type: application/json');
echo json_encode($json);


function salvarFoto($img){
	define('UPLOAD_DIR', 'profiles/');
	
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);
	return $success ? "Foto salva com sucesso!" : 'Unable to save the file.';
}

?>