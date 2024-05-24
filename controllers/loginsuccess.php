<?php
/**
*	Den 1.04.2024
*/

class Loginsuccess {
	use Controller;
	
	
	public function index(){
		
		$this->js = array('public/js/success.js');
		$data = [];
		$user = new User;
		
		/**
		 *	nach dem erfolgreicher registrieren alle Deine Persönlichen Daten
		 *	zum speichern oder drücken anzeigen
		 */
		$usersMail = empty($_SESSION['loginDaten']) ? NULL : $_SESSION['loginDaten']['usersdata'];
		if($usersMail != null && !empty($usersMail))
		{
			$arr['email'] = $usersMail;
			$row = $user->first($arr);
			$data['userData'] = $row;
		}
		
		$this->title = "successful";
		$this->view('loginsuccess', $data);
		
	}
}
?>