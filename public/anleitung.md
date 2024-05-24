						Kurze Anleitung zum starting
						
	yuotube link: https://www.youtube.com/watch?v=q0JhJBYi4sw					
						
	1. http://localhost:8888/verwaltung/
	wenn in der link wird nichts angegeben dann wir als Standart die controllers/login seite abgerufen
	in der App.php Zeile: 13
	
	2. http://localhost:8888/verwaltung/customer 
		 wenn in link wird die customer eingefügt dann wird in
		 App.php Zeile: 25 geprüft ob solche seite vorhanden is, wenn nein
		 dann wird die error seite geladen, App.php Zeile: 34...
		 wenn siete vorhanden ist dan wir die angegebene(customer) laden, App.php Zeile: 28
		 und gleich wird an den controllers/customer die methode index gestartet
		 mid den befel: call_user_func_array([$controller, $this->method], $URL); in App.php Zeile: 51
		 Quasi gesagt der befel 
		 			call_user_func_array([$controller, $this->method], $URL);
		  ist das gleiche wie:
		 $customer = new Customer;  // ist der class Customer in controllers/customer
		 $customer->index();				// startet die function index in controllers/customer
		 
		 der new Class wir in App.php Seite: 38 erzeugt: $controller = new $this->controller;
		 
	3.	weiter in den controllres/customer in der methode index wird die views seite geladen
		mit der methode, was liegt  in der core/Controller(Haupt)(weil der Haupt Controller ich extends in der 
		customer controllers) ... alls siet so aus...
		
		class Customer extends Controller {	
			public function index(){
				
				$data = [];
				echo'This is the Customer controller';
				
				$this->view('customer', $data); // abgerufene methode view in der core/Controller
				
			}
		}
		
	4.	DATABASE:  enderung im datenbank ausführen von jeden controllers...
	
	
		public function index(){
			
			......... verschiedene andere functionen
			
			**********************************************
			hier sin Beispiele wie sie erstellen array für datenbank speicherung
			oder einfache update ausführen, weiter beispiele sind in Model.php	
			
		/* 	$arr['datum'] = date("Y-m-d H:i:s");
			$arr['letztelogin'] = date("Y-m-d H:i:s");
			$arr['cookie'] = "987654321";
			$arr['login'] = "Letzte";
			$arr['password'] = "sob";
			$arr['passrecovery'] = "0987654321";
			$arr['role'] = "default";
			$arr['other'] = ""; */
			
		
			// $arr['id'] = 6;
			 //$arr['login'] = "Apostel";
			 //$arr['token'] = $token;
			 //$arr['email'] = "gott@gott.de";
			 
			//$result = $user->where($arr);	
			//$result = $loginmodel->update(15, $arr);	
			//show($result);
			
			
			***************************************
			
			// die login Seite laden von views/login.view.php
			//echo'This is the Login controller';
			$this->title = "Gott Jesus";
			$this->view('login', $data);
		} 
		
		
		
		******************************Login Sperre(Falsche Aktivierungscode) ******************************
	1.	bei 10 mal falsch angegbenes Aktivierungscode, wird der User gesperrt
		Ablauf die sperrung: in Logincode.php Zeile:46 bei falschen angabe die Aktivierungcode wird
		in $_SESSION['sperreCount'] die zahl gespeichert und dann in login.view.php und logincode.view.php
		Zeile: 26 die Zahl abgeruffen.. wenn über 10 dann die form wird ausgeblendet
		
		<!-- Sperre für 24 Stunden Starten -->
		<?php Session::sperreDestroy(); ?>
		
		<style>
			.formSperre	{display: none; }
		</style>	
		bei logincode.view.php wird noch zusetzlich den warn Text gesperrt
		
		FAZIT: die sperr session wird nach 24 Stunden zestört, Session.php/public static function sperreDestroy()	
			
		
		****************************** Globale ERRORS verwalten ******************************
		
	1. alle globale errors werden in models/GlobalError.php verwaltet und ins Datenbank
	    allerrors gespeichert
		was sie benötige das sind nur Zwei sachen, errors nummer + errors beschreibung,
		nicht vergessen in errorsliste den error nummer eintragen, wegen verwaltung
		*			<code>
		*				$globalerror = new GlobalError;												// Quelle-Classe, wo tritt error an
		*			   *$errornummer = 001;																// errornummer			
		*			   *$errortext = 'LoginModel.php/ try / $mailer->send(), Zeile: 93';  // Beschreibung des errors
	    *				$globalerror->errorMelden($errornummer, $errortext);				// an function daten übergeben
		*			</code>
		 
			
		
		
		
		****************************** Locale Fehler Ausgabe ******************************
		 
	5. 	Locale Fehler,  public $fehlers = [];  von Model.php anzeigen lassen in jeder html, 
		besteht aus 2 teilen, von controllers und models fehler ausgabe...
	
		a.  notwendie angaben in controllers/index
			public function index(){
			
			// models deklariren( wenn von da Fehler wird zugesendet)
			$loginmodel = new LoginModel;
			$data = [];  // data array deklariern
			
			
			// den Fehler in selber index erstellen und weiter an html übergeben(mit $data)
			if($loginmodel->validate($send ) ){
				
				// hier ist noch keinen fehle, aber unten in IF abfrage
				if($row){
					
				} else {
					show('first return: '.$row);
					$loginmodel->fehlers['telefon'] = "Keine Daten Gefunden!";
					
					 
				}
			}
			
			// false return von LoginModel/filter_var
			$data['fehlers'] =  $loginmodel->fehlers;
			
			
				// mit dem $data kann den Fehler übergeben an html-datei(hier ist der login.html)
				$this->view('login', $data);
			} // ende class index
		 
		 
		 b. wenn fehler wird von models zugesendet,(unserer b.s. LoginModel.php)
		 function validate($data){
		  
		  // den globale variable deklarieren
		  $this->fehlers = [];
		  
		  // dann in einer if abfrage den fehler erstellen
		  if (!filter_var($telemail, FILTER_VALIDATE_EMAIL)) {
				 
			   $this->fehlers['email'] = "... keine E-Mail-Adresse wiedergibt"; 
				// return false, weil Fehler da ist
			 }
			 
			 
			 // und hier wenn globale variable errors leer ist dann return true, in unserer fall
			 // oben in IF wird denn fehler erzeugt, daswegen return false, und in abschnitt 
			 //  'a' (in function index von controllers) wird dann der fehler ausgeben oder 
			 //	(richtig gesagt, weitergeleitet mit $this->view('login', $data); )
			 
			 if(empty($this->fehlers)){
				  return true;
			  }
				  return false;
		  
		  }
		  
		  
		  
		********************************** Globale variable $_SESSION *************************	
	6.0 Globale $_SESSION

		a. $_SESSION['loginDaten'] = $loginDaten;					// login Daten weiterleiten, controllers/login.php Zeile:  50
																						// Session::sessionSet('loginDaten', $loginData);
		b. $_SESSION['sperreCount'] = $loginSperre;				// controllers/logincode.php Zeile: 50
		c. 
		  
	6.1 Daten über die $_SESSION übergeben(die Globale variable)	
		  		1. von anfahg der start, Lieber in index ... die session_start ausfehüren
				2. dan in controllers/??? die $_SESSION vorbereiten, z.b.s
				class Login{
					use Controller;
					
					public function index()
					{
						$loginmodel = new LoginModel;  // hier liegt verbindung zum Datenbank
						$data = []; // für den Fehler anzeige oder daten weitergeben
						
						// aus dem Datenbank Daten holen
						$arr['email'] = $_POST['telemail'];
						$row = $loginmodel->first($arr);
						
						// Globale SESIION vorbereiten und neue seite aufrufen
						$_SESSION['LOGIN'] = $row;
						redirect('logincode');
					}	
				}	
					***	// Fazit: da sind die Daten von Datenbank geholt und in Globele variable
						// gespeichert in json format, die Globale variable $_SESSION['LOGIN']
						// der json von Datenbank.....
						show($_SESSION['LOGIN']);
						
					stdClass Object
						(
							[id] => 13
							[token] => 02052024151326
							[datum] => 2024-04-19 13:42:43
							[cookie] => 987654321
							[name] => Sam
							[vorname] => 
							[pseudonym] => 
							[email] => sam@sam.de
							[telefon] => 0987654321
							[role] => default
							[other] => 
						)
			
			3. auf der Logincode controllers
				class Logincode{
					 use Controller;
					 
					 public function index(){
						 
						$data = [];
						
						//print_r($_SESSION);
						//show($_SESSION['LOGIN']->email);
						//echo'Logincode: '.$_SESSION['LOGIN']->email;
						
						$data['usermail'] = empty($_SESSION['LOGIN']) ? 'leer' : $_SESSION['LOGIN']->email;
						
						$this->view('logincode', $data); 
					 }				 
				 }
				 
				 OUTPUT: auf die logincode.view.php
				 <body>
					 <h3>Login Code</h3>
					 <?=$usermail?>   // die erzeugte variable in class Logincode(hier gleich 9 spalten oben) 
				 </body>
				 
				 FAZIT: die Globale variable ($_SESSION['LOGIN']) was war in class Login erzeugt, wird in
				 			class Logincode bearbeiten und die e-mail-adresse in eine variable( $data['usermail'] ) gespeichert,
							die variable $data wird weiter zu logincode.view.php gesendet( $this->view('logincode', $data); ) und
							da ausgegeben als variable $usermail (siehe hier oben bei OUTPUT)
							
							
							 
		******************************* E-Mail versenden mit PHPMailer **************************************
	7.	bei registrierung wird eine e-mail mit den Aktivierungs Code zugesendet mit den PHPMailer +
		google e-mail-adresse
		 
		*  @PHPMailer: https://github.com/PHPMailer/PHPMailer?tab=readme-ov-file
		*			HILFE: https://www.youtube.com/watch?v=HTOJIEztA28
		*  Gesendet wird über den google Account von unbekanten@gmail.com
		*  google Voraussetzung:   2-Faktor-Authentifizierung + App-Password 
		
		der PHPMailer ordener liegt in util/PHPMailer, einbindung erfogt über require, 
		
		*	require 'util/PHPMailer/src/Exception.php';
		*  require 'util/PHPMailer/src/PHPMailer.php';
		*  require 'util/PHPMailer/src/SMTP.php';
		  
		*  use PHPMailer\PHPMailer\PHPMailer;
		*  use PHPMailer\PHPMailer\Exception;
		*  //use PHPMailer\PHPMailer\SMTP;
		
		* class LoginModel { 
			
			//die definierung erfolg über variable:
			$mailer = new PHPMailer(true);
			show($mailer);
		
		}
		
		ACHUNG: der Mailer functioniert gut (einen ausfürlichen b.s. in LoginModel.php)
		FAZIT: nachteil, das versenden wird durch eine feste google e-mail-accound, kann andere mail nicht benutzen
				   und google braucht die 2-Faktor-Authentifizierung + App-Password 
	
		******************************
	8.				   
				 