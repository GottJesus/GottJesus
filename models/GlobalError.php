<?php
/**
 *	Den 9.05.2024
 */
 
 class GlobalError{
	 
	 use Model;
	 
	 protected $table = "allerrors";
	 protected $allowedColumns = [
	 
		 'id',												// int, auto_increment
		 'errornummer',								// int
		 'errordatum',									// varchar(32)
		 'errortext',									// varchar(255)
		 'errorcount',									// int
		 'errorerledigtdatum',						// Rest varchar(32)
		 'role',
		 'other',
	 ];
	
	/**
	 *  ACHTUNG: zugriff auf Datenbank von hier
	 *      $row =  $this->first($mail);  // $mail, muss eine json sein
	 *      $row->email                        // einzeln Ausgabe....(ACHTUNG: nicht für where function)
	 */
	 
	 
	
	 
	
	/**
	 *	Globale Fehler ins Datenbank speichern(für verwaltung.gottjesus.de)
	 *
	 *	Beschreibung: Das Fehler wird nur einmal ins Datenbank gespeichert, nach fehlernummer
	 *						 abgefragt, meldung von anderer User wird nur noch hochgezählt...
	 *	FAZIT: Fehler nach ip-Adresse wird nicht abgefragt, kann vorkommen von einem User
	 *			   mehrmals count hochgezählt..	  	 
	 *	 
	 *	die nötigste Zwei Parameter was sollte zugesendet sein, von anderer script/controllers
	 *			<code>
	 *				$globalerror = new GlobalError;												// Error Quelle-Classe
	 *				$errornummer = 001;																// errornummer			
	 *				$errortext = 'LoginModel.php/ try / $mailer->send(), Zeile: 93';  // Beschreibung des errors
	 *				$globalerror->errorMelden($errornummer, $errortext);				// an function Daten übergeben
	 *			</code> 
	 */ 
	 function errorMelden($errorNummer, $errorText ){
		
		 $errorDatum = date('Y-m-d H:i');	
		 $errorSuchen['errornummer'] = $errorNummer;
		 $row = $this->first($errorSuchen);
		  
		 if($row != null && $row->errornummer === $errorNummer){
			 
			 /**
			  *	wenn Fehler-Nummer vorhanden ist dann nur count erhöhen
			  */
			 $count = $row->errorcount;
			 $count = $count + 1;
			 $updateCount['errorcount'] = $count;			 
			 $this->update($row->id, $updateCount);
			 
		 } else {
			 
			 /**
			  * wenn Fehler nicht vorhanden ist, neu eintragen
			  */
			 $arr['errornummer'] = $errorNummer; 
			 $arr['errordatum'] = $errorDatum; 
			 $arr['errortext'] = $errorText;
			 $arr['errorcount'] = 1;
			 $arr['errorerledigtdatum'] = '';
			 $arr['role'] = '';
			 $arr['other'] = '';
			 $this->insert($arr);
		 }

		 
	 } 
	 	 
 }
?>
