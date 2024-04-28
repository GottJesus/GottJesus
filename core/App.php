<?php 
/**
*	Den 1.04.2024
*/

class App {
	
	private $controller = 'login';
	private $method		= 'index';

private function splitURL() {
	
	$URL = $_GET['url'] ?? 'login';
	$URL = explode("/", trim($URL, "/"));
	return $URL;
}


public function loadController(){
	
	$URL = $this->splitURL();
	
	/** select controller  **/
	$filename = "controllers/".ucfirst($URL[0]).".php";	
	if(file_exists($filename)) {
		
		require $filename;
		$this->controller = ucfirst($URL[0]);
		unset($URL[0]);
				
	} else {
		
		$filename = "controllers/_404.php";
		require $filename;
		$this->controller = "_404";
	}

	$controller = new $this->controller;
	
	/** select method **/
	if(!empty($URL[1])) {
		
		if(method_exists($controller, $URL[1])) {
			$this->method = $URL[1];
			unset($URL[1]);
		}
		
	}

	// Startet in controllers/login.php ( oder anderer, _404.php, customer.php)  die function index()
	call_user_func_array([$controller, $this->method], $URL);
	
    }
	
}

?>