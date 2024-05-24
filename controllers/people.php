<?php
/**
*	Den 1.04.2024
*/

class People {
	use Controller;
	
	
	public function index(){
		
		Auth::handleLogin();
		
		$people = new PeopleModel;
		$data = [];
		
		
		
		echo'This is the People controller<br>';
		echo'<br>COOKIE: ';
		show($_COOKIE);
		echo'<br>SESSION: ';
		show($_SESSION);
		
		
		$this->title = "People";
		$this->view('people', $data);
		
	}
}
?>