<?php
 
/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Firebase {
    
    // get all tokens logged users
    public function getTokens(){
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
        } 
        return $json;  
    }

    // sending push message to single user by firebase reg id
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'notification' => $message,
        );
        return $this->sendPushNotification($fields);
    }
 
    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'notification' => $message,
        );
        return $this->sendPushNotification($fields);
    }
 
    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($message) {        
        $registration_ids = $this->getTokens();
        $fields = array(
            'registration_ids' => $registration_ids,
            'notification' => $message,
        );
 
        return $this->sendPushNotification($fields);
    }
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
         
        require_once "../config/configKey.php";
 
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
 
        $headers = array(
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
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }                       
        // Close connection
        curl_close($ch);
 
        return $result;
    }
}
?>