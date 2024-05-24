<?php
/**
 *	Den 1.04.2024
 */

  
  require 'util/PHPMailer/src/Exception.php';
  require 'util/PHPMailer/src/PHPMailer.php';
  require 'util/PHPMailer/src/SMTP.php';
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  //use PHPMailer\PHPMailer\SMTP;

 class LoginModel {
	
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
     * E-Mail auf Gültigkeit Prüfen und Aktivierung Code an neue User senden
     */
    function validateMail($email, $code){
        
         // fehlers ist eine Locale Fehler Ausgabe, definiert in Model.php
        //$this->fehlers = [];
        
        /**
         *  E-Mail aus Gültigkeit prüfen
         */
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
         {
                
            $this->fehlers['email'] = "... Ung&#252;ltige E-Mail-Adresse"; 
               // return false, weil Fehler da ist
        }
        else 
        {
            /**
             * E-Mai an neuen User versenden mit PHPMailer...(util/PHPMailer)
             *  
             *  @PHPMailer: https://github.com/PHPMailer/PHPMailer?tab=readme-ov-file
             *  Gesendet wird über den google Account von unbekanten@gmail.com
             *  google Voraussetzung:   2-Faktor-Authentifizierung + App-Password  
             */
            $globalerror = new GlobalError; 
            $mailer = new PHPMailer(true);
                               
            try{
                // Server Settings                
                $mailer->isSMTP();
                $mailer->Host = 'smtp.gmail.com';
                $mailer->Port = 587;                                                             // 465
                $mailer->SMTPAuth = TRUE;
                $mailer->SMTPSecure = 'TLS';                                              // SSL
                $mailer->Username   = 'unbekanten@gmail.com';
                $mailer->Password   = 'mehwkytvacwvmyeg';                         // google: App-Password
                
                
                //Recipients
                $mailer->setFrom('unbekanten@gmail.com', 'Gott Jesus');
                $mailer->addAddress($email);
                
                // Content
                $mailer->isHTML(TRUE);
                $mailer->Subject = "Deine Zugangscode: ".$code;
                $mailer->Body = "hier erhalten Sie ihre Messenger Aktivierung Code<br>  <b>".$code.
                   "</b> <br> Gültigkeit dauert nur für diese sitzung  <br><br> mit Freundlichen Grüßen <br> Ihr Messias Team  ";
                 
                
                 /**
                  *  den Fehler wird Global in Datenbank gespeichert(models/GlobalFehler.php)
                  */
                 // Mail Senden
/*                  if( !$mailer->send() ) {
                
                    $this->fehlers['mailerSend'] = "E-Mails können nicht gesendet werden";
                    $errornummer = 002;
                    $errortext = 'LoginModel.php/ PHPMailer / try / $mailer->send(), Zeile: 100';
                    $globalerror->errorMelden($errornummer, $errortext);       
                } */
                
                /**
                 * wenn e-mail ohne Fehler versendet wird dann return true
                 *
                 *  true wird zurückgesendet an controllers/login/validateMail()...
                 * controllers/login/if($loginmodel->validateMail($arr, $aktivierungsCode)) {
                 *          // weiter zu logincode.view.php
                 *       }
                 */
               
            } catch(Exception $e)
            {
                /**
                 *  den Fehler wird Global in Datenbank gespeichert(models/GlobalFehler.php)
                 */
                $this->fehlers['mailer'] = $e->errorMessage();
                //echo'Catch:  '. $e->errorMessage();
                $errornummer = 001;
                $errortext = 'LoginModel.php/ PHPMailer / catch(Exception), Zeile: 123';
                $globalerror->errorMelden($errornummer, $errortext); 
             }

        }
        
        /**
         *  wenn errors leer ist dann return true
         */
        if(empty($this->fehlers)){
             return true;
        }
             return false;    
    } 
    
    
    
    /**
     *  SMS an angegebene Telefon versenden mit dem textlocal.com 
     *  versendet ohne Fehler aber kann nicht überprüfen weil habe bei 
     *  textlocal.com keine Credits...Einwahl Daten sind in Text-Datei(example/sms-mail-sender)
     *
     *      *die Letzte response war am 14.05.2024 die output ist unten
     *
     *        {"balance":-1,"batch_id":2096836683,"cost":1,"num_messages":1,"message":{"num_parts":1,"sender":"Gott Jesus",
     *       "content":"Guten Tag
     *       Ihr Sicherheitstoken: 9044<\/b>
     *       Bitte beachten Sie, dass dieser Token nur 15 Minuten g\u00fcltig ist."},"receipt_url":"","custom":"",
     *       "messages":[{"id":"13154389786","recipient":12018577757}],"status":"success"}
     *
     *       *ACHTUNG: wenn SMS wird nicht versendet dann kommt errors
     * 
     *       {"errors":[{"code":7,"message":"Insufficient credits"}],"status":"failure"}  
     */
     function validateTelefon($telefon, $code){
         
        $regex = '/^\+(?:[0-9] ?){6,14}[0-9]$/';
        
        if ( preg_match($regex, $telefon) ) {
          
          $telephone = str_replace([' ','+', '.', '-', '(', ')'], '', $telefon);
           
           // Account details
           $apiKey = urlencode('NjIzNjc4NzU3NzZkNjczNzUyNjI3MTRhNjg1MzQzNDQ=');
           $messageText = 'Guten Tag<br> Ihr Sicherheitstoken: <b>'. $code .'</b> <br> Bitte beachten Sie, dass dieser Token nur 15 Minuten g&#252;ltig ist.';
           
           // Message details
           $numbers = array($telephone);
           $sender = urlencode('Gott Jesus');
           $message = rawurlencode($messageText);
           
           //echo $message;
           
           $numbers = implode(',', $numbers);
           
           // Prepare data for POST request
           $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
           
           // Send the POST request with cURL
/*            $ch = curl_init('https://api.txtlocal.com/send/');
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           $response = curl_exec($ch);
           curl_close($ch); */
          
           // Process your response here
           //echo $response;
           
           /**
            * ACHTUNG: die SMS versenden steht zurzeit nicht zum verfügung weil bei textlocal.com
            *                  sind keine Credits da, die senden ist auskommentier, hier gleich oben
            * FAZIT: wenn soll zum Testen frei machen,  dann unten Fehler Ausgabe Löschen und oben
            *            die teil Send the POST einfach frei machen   
            */
            $this->fehlers['sms'] =  "Das Telefonnummer-Registrierung, steht vorübergehend nicht zur Verfügung.<br>
                                                Bitte Registrieren/Anmelden Sie sich mit Ihrer E-Mail-Adresse.<br> Danke ";
                      
        } else {
            
            // Invalid international phone number
            $this->fehlers['telefon'] = "Dein Telefonnummer ist nicht korrekt";
            
        }
        
        
        
        /**
         *  wenn errors leer ist dann return true
         */
        if(empty($this->fehlers)){
             return true;
        }
             return false; 
         
     }
         
 }
?>