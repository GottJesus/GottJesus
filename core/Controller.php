<?php
/**
*	Den 1.04.2024
*/

class Controller {
	
	public function view($name){
		
		$filename = "views/".$name.".view.php";
		if(file_exists($filename)){
			
			require $filename;
			
		} else {
			
			$filename = "views/404.view.php";
			require $filename;
			
		}
	}
	
}
?>