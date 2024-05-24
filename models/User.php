<?php
/**
 *	Den 1.04.2024
 */
 
 class User {
	 
	use Model;
    
    protected $table = "user";
    protected $allowedColumns = [
    
        'id',
        'token',
        'datum',
        'cookie',
        'name',
        'vorname',
        'pseudonym',
        'email',
        'telefon',
        'language',
        'role',
        'other',
    ];
    /**
     *  ACHTUNG: zugriff auf Datenbank von hier
     *      $row =  $this->first($mail);  // $mail, muss eine json sein
     *      $row->email                        // einzeln Ausgabe....(ACHTUNG: nicht für where function)
     */
     
    
    
    /**
     * wenn in Datenbank wird keine E-Mail gefunden dann neuen User eintragen
     * bei Datenbank Fehler wir eine Globale errors ins Datenbank gespeichert
     *   Zeile: 74
     */
    function newUser($mail){
        
        $token          = newToken();
        $datum         = usDatum();
        $telefon        = is_numeric($mail) ?? $mail;
        $sprache      = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if(!isset($_COOKIE['loggedIn']) && empty($_COOKIE['loggedIn']))
            {
                $cookiegultig = time()+788918400;	//fur 25 jahr
                setcookie('loggedIn', $token, $cookiegultig);
            }
        
        $suchen['email'] = $mail;
        $row = $this->first($suchen);
        if(!$row)
        {
              
            $arr['token']           = $token;
            $arr['datum']          = $datum;
            $arr['cookie']         = $token;
            $arr['name']           = '';
            $arr['vorname']       = '';
            $arr['pseudonym']   = '';
            $arr['email']           = $mail;
            $arr['telefon']         = $telefon;
            $arr['language']      = $sprache;
            $arr['role']              = '';
            $arr['other']            = '';
             
            $result = 'einganst daten'; //$this->insert($arr);
            if($result)
            {
                $this->fehlers['mysql'] = "Sie konnten nicht angemeldet werden, 
                weil Ein Sendefehler ist bei der Datenübertragung aufgetreten. 
                <br><b>Fehler wird Automatisch gemeldet...</b>.";
                
                // errors ins Datenbank speichern
                $globalerror = new GlobalError;							
                $errornummer = 003;																			
                $errortext = 'models/User.php mysql return($result, 67)'; 
                $globalerror->errorMelden($errornummer, $errortext);
            }                 
        } else {
            
            $id = $row->id;
            $arr['cookie'] = $token;
            $this->update($id, $arr);
        }

        // wenn oben wird keinen Fehler eintreten, return true     
       if(empty($this->fehlers))
       {
           return true;
       } 
           return false;
           
    } // Ende newUser
	 	 
 }
?>