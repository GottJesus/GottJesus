<?php
/**
 *	Den 1.04.2024
 */

	trait Model  {
		
		use Database;
		
		/**
		 * ACHTUNG: der Verbindung zum MySql-Datenbank ist in Database.php + die query function
	     *
		 *	zugriff von models:   		  $row =  $this->where($mail);
		 *	 									  var_dump($row);	
		 *
		 *	zugriff von controllers			public function index(){
		 *												// in models liegt der Datenbank Name + columns	 
		 *												$loginmodel = new LoginModel;
		 *												 	 
		 * 	 											$row = $loginmodel->where($userdaten);
		 *												var_dump($row);
		 *										 }
		 *
		 *	ACHTUNG: unterschied zwischen function where und first
		 *	first: 					$row =  $this->first($mail);
	     *							echo'E-Mail gefunden: '.$row->email.'<br>';	 
		 * where:				Ausgabe wahrscheinlich müssen per for schleife erledigen
		 */
		
		//protected $table = "user";  // in models/...class initialisiert, nach bedarf weiches Tabelle braucht 
		protected $limit 					= 10;
		protected $offset 				= 0;
		protected $order_type 		= "desc";
		protected $order_column 	= "id";
		public $fehlers 					= [];
		
		
		/**
		 * die findAll function, so sieht den Outputt
		 * 
		 *	 Array
		 *	 (
		 *		 [0] => stdClass Object
		 *			 (
		 *				 [id] => 19
		 *				 [datum] => 2024-04-19 18:56:40
		 *				 [letztelogin] => 2024-04-19 18:56:40
		 *				 [cookie] => 987654321
		 *				 [login] => Letzte
		 *				 [password] => sob
		 *				 [passrecovery] => 0987654321
		 *				 [role] => default
		 *				 [other] => 
		 *			 )
		 *	 
		 *		 [1] => stdClass Object
		 *			 (
		 *				 [id] => 18
		 *				 [datum] => 2024-04-19 18:04:59
		 *				 [letztelogin] => 2024-04-19 18:04:59
		 *				 [cookie] => 987654321
		 *				 [login] => Unbekannt
		 *				 [password] => resetUpadte
		 *				 [passrecovery] => 0987654321
		 *				 [role] => default
		 *				 [other] => 
		 *			 )
		 *	 
		 *		 [2] => stdClass Object
		 *		 
		 *		 und so weiter bis Limit erreicht ist (limit = 10)
		 */
		public function findAll()
		{
		 
			$query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		
			return $this->query($query);
		}
		
		/**
		 *	code: die where function brauch nur einen parameter um Daten von einem user holen
		 *			 eine ID, Name oder login .....z.b.s $arr['id'] = "2"; oder $arr['login'] = "Satan";
		 *			// so sieht der array zum senden aus:
		 *				Array
		 *						(
		 *								 [email] => fgeagfae@eafgae.ddd
		 *						)	 
		 *  // hier unten einen Beispiel von einen class Login	 
		 *	class Login {
		 *			use Controller;
		 *		public function index(){
		 *	 		$model = new Model;
		 *							 
		 *	 		$arr['passrecovery'] = "03062021094046"; oder  
		 *			//$arr['login'] = "Satan";  oder  $arr['id'] = "2";
		 *	 
		 *	 		$result = $model->where($arr);
		 *	 		show($result);
		 *		}	
		 *		OUTPUT: von show($result) // hier werden Daten mit passrecovery Nummer geholt
		 *	 	Array
		 *		 (
		 *			 [0] => stdClass Object
		 *				 (
		 *					 [id] => 6
		 *					 [datum] => 2021-06-03 09:40:46
		 *					 [letztelogin] => 2021-06-03 09:41:20
		 *					 [cookie] => 31052021101109
		 *					 [login] => Apostel
		 *					 [password] => 7aef561e600464662a2431851d1fbb68
		 *					 [passrecovery] => 03062021094046
		 *					 [role] => default
		 *					 [other] => 
		 *				 )
		 *		 
		 *		 ) 
		 */
		public function where($data, $data_not = [])
		{
			$keys = array_keys($data);
			$keys_not = array_keys($data_not);
			$query = "select * from $this->table where ";
			
			foreach ($keys as $key) {
				$query .= $key . " = :". $key . " && ";
			}
			
			foreach ($keys_not as $key) {
				$query .= $key . " != :". $key . " && ";
			}
			
			$query = trim($query," && ");
			
			$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
			$data = array_merge($data, $data_not);
			
			return $this->query($query, $data);
		}
		
		/**
		 * die first function ist genau wie where
		 *	Rückgabe wert ist als Object 
		 *	OUTPUT:  		$row =  $this->first($mail);
		 *						echo'E-Mail gefunden: '.$row->email.'<br>';
		 *		 			    show($row);
		 *
		 * 		stdClass Object
		 *			(
		 *	 			[id] => 5
		 *	 			[datum] => 2021-06-03 09:30:49
		 *	 			[letztelogin] => 2021-06-03 19:13:36
		 *	 			[cookie] => 28052021143505
		 *	 			[login] => Satan
		 *	 			[password] => 87df2cd1570fd297de238aeee667fe0a
		 *	 			[passrecovery] => 03062021093049
		 *	 			[role] => default
		 *	 			[other] => 
		 *			)
		 */
		public function first($data, $data_not = [])
		{
			$keys = array_keys($data);
			$keys_not = array_keys($data_not);
			$query = "select * from $this->table where ";
		
			foreach ($keys as $key) {
				$query .= $key . " = :". $key . " && ";
			}
		
			foreach ($keys_not as $key) {
				$query .= $key . " != :". $key . " && ";
			}
			
			$query = trim($query," && ");
		
			$query .= " limit $this->limit offset $this->offset";
			$data = array_merge($data, $data_not);
			
			$result = $this->query($query, $data);
			if($result)
				return $result[0];
		
			return false;
		}
		
		
		
		/**
		 * die inset function brauch alle Daten von der neuen User zugesendet
		 *	ACHTUNG: alle columns müssen in array vorhanden sein(wens leer sind)
		 *	 
		 * einen Beispiel von der Login class
		 *
		 * 		class Login {
		 *					use Controller;
		 *
		 *			public function index()
		 *			{
		 *	 					$model = new Model;
		 *	 
		 *	 			$arr['datum'] = date("Y-m-d H:i:s");
		 *	 			$arr['letztelogin'] = date("Y-m-d H:i:s");
		 *	 			$arr['cookie'] = "987654321";
		 *	 			$arr['login'] = "Sam";
		 *	 			$arr['password'] = "sam";
		 *	 			$arr['passrecovery'] = "0987654321";
		 *	 			$arr['role'] = "default";
		 *	 			$arr['other'] = "";
		 *	 
		 *	 			$model->insert($arr);  // die Speicherung Daten werden an Model/inset gesendet
		 *				
		 *				ACHTUNG: wenn von models/????Model.php muss ausgeführt werden...(siehe b.s. GlobalFehler.php)
		 *	 			$this->insert($arr);
		 *			}
		 *		}
		 */
		public function insert($data)
		{
			/** remove unwanted data **/
			if(!empty($this->allowedColumns))
			{
				foreach ($data as $key => $value) {
					
					if(!in_array($key, $this->allowedColumns))
					{
						unset($data[$key]);
					}
				}
			}
			
			$keys = array_keys($data);
			
			$query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(",:", $keys).")";
			$this->query($query, $data);
			
			return false;
		}
		
		/**
		 * die update function braucht 2(oder mehr) Parameter, eine ID und was muss geändert sein
		 *	WICHTIG: zuerst ID + parameter 1oder mehr, unten ist einen Beispiel von den Login class
		 *
		 *		class Login {
		 *				use Controller;
		 *
		 *			public function index(){
		 *	 					$model = new Model;
		 *	 
		 *	 			$arr['cookie'] = "1234567"; 
		 *	 			$arr['password'] = "neuspass"; 
		 *	
		 *	 			$result = $model->update(13, $arr);   // an update function senden: ID + parameter
		 *				 	
		 *				 //$result = $model->update(13, $arr);	
		 *	 			//show($result);	
		 *			 }
		 *		 }
		 *
		 *		ACHTUNG: Löschen Möglich NUR nach ID
		 */
		public function update($id, $data, $id_column = 'id')
		{
			/** remove unwanted data **/
			if(!empty($this->allowedColumns))
			{
				foreach ($data as $key => $value) {
					
					if(!in_array($key, $this->allowedColumns))
					{
						unset($data[$key]);
					}
				}
			}
			
			$keys = array_keys($data);
			$query = "UPDATE $this->table SET ";
			
			foreach ($keys as $key) {
				$query .= $key . " = :". $key . ", ";
			}
			
			$query = trim($query,", ");
			
			$query .= " where $id_column = :$id_column ";
			
			$data[$id_column] = $id;
			
			$this->query($query, $data);
			return false;
		}
		
		
		/**
		 *	die delete function muss nur einen parameter zugesendet sein, die ID
		 *
		 * 		class Login {
		 *					use Controller;
		 *
		 *			public function index(){ 
		 *	 			$model = new Model;
		 *	 				
		 *				$model->delete(8);   // die User mit ID-Nummer 8 wird gelöscht
		 *			}
		 *		}
		 */
		public function delete($id, $id_column = 'id')
		{
			$data[$id_column] = $id;
			$query = "DELETE FROM $this->table where $id_column = :$id_column";
			$this->query($query, $data);
			return false;
		}
		
		
	}
?>