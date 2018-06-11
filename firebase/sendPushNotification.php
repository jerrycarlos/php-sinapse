<?php
// API access key from Google API's Console
//define( 'API_ACCESS_KEY', 'AAAASOKenyc:APA91bHcUbYSBtGlL0c3iYwwksQhaSjtbz2pa1GnIeIsILSDyL_biWhKOh0YDKmfwS0adPmwF1DE7mS_nMQJ4BQ9ox7XLIw-9r1rSYSjN-9ypBfSSXfec82Liy8v_EKnbaXUNhw6nTnn' );
	require "../config/configKey.php";
	require "../config/defineDB.php";
	require "../config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);				
		$json = array();					
		$sql = "SELECT tokenId from usuario where tokenId IS NOT NULL";			
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){				
			while($registro = mysqli_fetch_assoc($consulta)){
				array_push($json, $registro['tokenId']);				
			}	
			//print_r($json);
			sendNotification($json);
												
		}

		function sendNotification($registrationIds){
			// prep the bundle
			$msg = array
			(
				'message' 	=> 'here is a message. message',
				'title'		=> 'This is a title. title',
				'subtitle'	=> 'This is a subtitle. subtitle',
				'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
				'vibrate'	=> 1,
				'sound'		=> 1,
				'largeIcon'	=> 'large_icon',
				'smallIcon'	=> 'small_icon'
			);
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
			echo $result;	
		}
?>

<?php
// API access key from Google API's Console
//define( 'API_ACCESS_KEY', 'AAAASOKenyc:APA91bHcUbYSBtGlL0c3iYwwksQhaSjtbz2pa1GnIeIsILSDyL_biWhKOh0YDKmfwS0adPmwF1DE7mS_nMQJ4BQ9ox7XLIw-9r1rSYSjN-9ypBfSSXfec82Liy8v_EKnbaXUNhw6nTnn' );
	require "../config/configKey.php";
	require "../config/defineDB.php";
	require "../config/conectaBanco.class.php";	
	$banco = new ConectaBanco();
	$banco->conectaBanco($dbserver,$dbuser,$dbpwd,$dbuse);				
		$json = array();					
		$sql = "SELECT tokenId from usuario where tokenId IS NOT NULL";			
		$consulta = $banco->executa($sql);	
		if(mysqli_num_rows ($consulta) > 0){				
			while($registro = mysqli_fetch_assoc($consulta)){
				array_push($json, $registro['tokenId']);				
			}	
			$registrationIds = $json;
												
		}

		/**
		* 
		*
		*
		*/
		function sendNotification($registrationIds){
			// prep the bundle
			$msg = array
			(
				'message' 	=> 'here is a message. message',
				'title'		=> 'This is a title. title',
				'subtitle'	=> 'This is a subtitle. subtitle',
				'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
				'vibrate'	=> 1,
				'sound'		=> 1,
				'largeIcon'	=> 'large_icon',
				'smallIcon'	=> 'small_icon'
			);
			$fields = array
			(
				'to' => $registrationIds, //para enviar via topic, ou seja, para todo usuario logado, alterar 'to' para 'registration_ids'
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
			echo $result;	
		}
?>