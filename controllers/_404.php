<?php
/**
*	Den 1.04.2024
*/

class _404 {
	use Controller;
	
	public function index(){
		
		//echo'This is the 404 Controller';
		
		$this->view('404');
	}
	
}

?>