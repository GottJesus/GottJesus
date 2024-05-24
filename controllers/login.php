<?php
/**
 *	Den 1.04.2024
 */

class Login {
	use Controller;

	public function index(){
			
		$loginmodel = new LoginModel;
		$data = [];
	
		/**
		 *	die E-Mail-Adresse wird auf Gültigkeit geprüft und Telefon auf
		 * numerisch Zahle, dann werden sie weiter an logincode.php versendet  
		 */		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$aktivierungsCode = zufallCode(); 						// core/functions
			$inputDaten = $_POST['telemail'];						// view/login.view.php
							
			if(is_numeric($inputDaten)) {
								
				if( $loginmodel->validateTelefon($inputDaten, $aktivierungsCode) ){
					
					/**
					 *  ACHTUNG: Das Telefon Registrierung steht Zurzeit nicht zum verfügung...
					 *	 
					 *  FAZIT: wenn soll einen Test durchgeführt sein.. dann hier untere Teil freimachen 
					 *	 und in der LoginModel.php Zeile: 183 auch frei machen + Fehler Ausgabe Löschen 
					 *	 Zeile: 199	 	 	 
					 */
					
					/* $loginData['usersdata'] = $inputDaten; 
					$loginData['userscode'] = $aktivierungsCode;
					
					Session::sessionSet('loginDaten', $loginData);
					redirect('logincode'); */
				}
				
			} else {
				
				if( $loginmodel->validateMail($inputDaten, $aktivierungsCode) ) {
					
					$loginData['usersdata'] = $inputDaten; 
					$loginData['userscode'] = $aktivierungsCode; 
					
					Session::sessionSet('loginDaten', $loginData);
					redirect('logincode');				
				}
				
			}
					
		} 
				
		// Fehler Ausgabe: wenn return nicht leer ist, von LoginModel/filter_var oder Telefon
		$data['fehlers'] =  $loginmodel->fehlers;
	
		// Login Seite Starten
		$this->title = "Login";
	 	( !isset($_COOKIE['loggedIn']) ) ? $this->view('login', $data) : redirect('people');

		
	}
	
}
?>