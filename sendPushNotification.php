<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	require "../config/configKey.php";
	require "../config/defineDB.php";
	require "../config/conectaBanco.class.php";	
	require "pushNotification.php";
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);	
	$data = json_decode(file_get_contents('php://input'), true);			
		$json = array();					
		$sql = "SELECT tokenId from usuario where tokenId IS NOT NULL";			
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){				
			while($registro = mysqli_fetch_assoc($consulta)){
				array_push($json, $registro['tokenId']);				
			}
			$fkLocal = $data['fkLocal'];
			$sql = "SELECT nome_fantasia from instituicoes where id = '$fkLocal'";			
			$consulta = $banco->executa($sql);			
			while($registro = mysqli_fetch_assoc($consulta)){
				$local = $registro['nome_fantasia'];				
			}
			//print_r($json);
			$ev = new Push();
			$ev->setTitle($data['title']);
			$msg = "Descricao: " . $data['body'] . "\nLocal: " . $local;
			$ev->setMessage($msg);
			$ev->setImage("");
			sendNotification($json,$ev->getPush());
												
		}
}else{
// Insert data into data base
	$json = array("status" => 0, "msg" => "Metodo nao post!");
	//header('Content-type: application/json');
	//echo json_encode($json);
}

		function sendNotification($registrationIds,$msg){
			// prep the bundle
			$fields = array
			(
				'registration_ids' => $registrationIds,
				'notification' => $msg
			);
			 
			$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
			 
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch );
			curl_close( $ch );
			header('Content-type: application/json');
			echo json_encode($result);
		}
?>