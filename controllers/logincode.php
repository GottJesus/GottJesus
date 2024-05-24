<?php 
/**
 *	Den 5.05.2024
 */
 
 class Logincode{
	 use Controller;
	  
	 public function index(){
		 
		//$this->js = array('public/js/logincode.js');   // zurzeit existiert nicht
		$user = new User;
		$data = [];
				
		// Session erstellt in login.php Zeile: 33 +49
		$loginsCode 	= empty($_SESSION['loginDaten']) ? NULL : trim( $_SESSION['loginDaten']['userscode'] );
		$loginsData 	= empty($_SESSION['loginDaten']) ? NULL : $_SESSION['loginDaten']['usersdata'];
			
		if( $_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$codeEins = $_POST['codeEins'];
			$codeZwei = $_POST['codeZwei'];
			$codeDrei = $_POST['codeDrei'];
			$codeVier = $_POST['codeVier'];
			$codeTotal = trim($codeEins.$codeZwei.$codeDrei.$codeVier);	
			
			// wenn Aktivierungscode stimmt, weiter leiten + alle Sessions Löschen	
			if($loginsCode === $codeTotal){
				
				if( $user->newUser($loginsData) )
				{
					redirect('loginsuccess');
				}
									
			}			

			// wenn Aktivierungscode Falsch ist
			$user->fehlers['falschecode'] = "Ungültiger Aktivierungscode";
			$data['fehlers'] = $user->fehlers;
			
			/**
			 *  Wiederholte Fehlversuche, count session anlegen
			 *  gesperrt wird in logincode.view.php Zeile: 31	 
			 *  Benutzt: login.view.php Zeile: 27 + logincode.view.php Zeile: 26	 
			 */
			$loginSperre = empty($_SESSION['sperreCount']) ? $_SESSION['sperreCount'] = 1 : 
					$loginSperre = $_SESSION['sperreCount']; 
					$loginSperre = $loginSperre +1;
					$_SESSION['sperreCount'] = $loginSperre;
							
		}

		//E-Mail oder Telefon weiter leiten zum logincode.view.php(var. $logindata)	
		$data['logindata'] = $loginsData;
		$this->title = "Gott Jesus";
		( !isset($_COOKIE['loggedIn']) ) ? $this->view('logincode', $data) : redirect('people');
		
	 }
	 
 }
?>