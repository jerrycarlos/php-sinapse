<?php	
	class ConectaBanco{
		private $server;
		private $user;
		private $pwd;
		private $db;
		private $link;	
		function __construct(){
		}

		public function conectaBanco($server,$user,$pwd,$db){			
			$this->link = mysqli_connect($server,$user,$pwd,$db);
			if($this->link->connect_error){
				die("Connection failed: " . $this->link->connect_error);
			}
			//return $link;
		}

		public function executa($sql){
			return mysqli_query($this->link,$sql);
		}

		public function fetch($result){
			$array = mysqli_fetch_array($result);
			return $array;
		}

		public function assoc($result){
            
		}

		public function close(){
			mysqli_close($this->link);
		}

		public function linkError(){
			return $this->link->error;
		}
		public function getLink(){
			return $this->link;
		}
	}
?>