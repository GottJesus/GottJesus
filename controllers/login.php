<?php
/**
 *	Den 1.04.2024
 */

class Login extends Controller {
	

	public function index(){
		
		$user = new User;
		//$user = User;
		
	/* 	$arr['datum'] = date("Y-m-d H:i:s");
		$arr['letztelogin'] = date("Y-m-d H:i:s");
		$arr['cookie'] = "987654321";
		$arr['login'] = "Letzte";
		$arr['password'] = "sob";
		$arr['passrecovery'] = "0987654321";
		$arr['role'] = "default";
		$arr['other'] = ""; */
		

		 $arr['id'] = 6;
		 $arr['login'] = "Apostel";
		 
		$result = $user->where($arr);	
		show($result);
		
		// die login Seite laden von views/login.view.php
		//echo'This is the Login controller';
		$this->view('login');
	}
	
	
}
?>