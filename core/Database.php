<?php
/**
 *	Den 1.04.2024
 */

trait Database {
	
	private function connect()
	{
		$string  = "mysql:hostname=".DB_HOST.";dbname=".DB_NAME;
		$con		= new PDO($string,DB_USER,DB_PASS );
		return $con;
	}
	
	public function query($query, $data = [])
	{
		$con = $this->connect();
		$stm = $con->prepare($query);
		
		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result;
			}
		}
		
		return false;
	}
		
/* 		public function __construct( $DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_OPTI ){
			parent::__construct( $DB_TYPE.':host='.$DB_HOST.'; dbname='.$DB_NAME, $DB_USER, $DB_PASS, $DB_OPTI );
			
			//perent::setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS );
		} */
		


}
?>