<?php
/**
 *	Den 1.04.2024	
 */
 
 	 
	class Session{
		
		public static function sessionInit()
		{
			session_start();
		}
		
		
		public static function sessionSet($key, $value)
		{
			$_SESSION[$key] = $value;
		}
		
		
		public static function sessionGet($key)
		{
			if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		}
		
		public static function sessionUnset($key)
		{
			unset($_SESSION[$key]);
		}
		
		
		public static function sessionDestroy()
		{
			$_SESSION = array();			// SESSION leeren, weil
			session_destroy();				// session_destroy <- funktioniert nicht immer
		}
		
		// Sperre session nach 24 Stunden zerstören
		public static function sperreDestroy()
		{
			if (!isset($_SESSION['timerDestroy'])) 
			{
				$_SESSION['timerDestroy']=time();
			}
			  
			if ($_SESSION['timerDestroy'] < (time() - 3600000)) 	// Eine Stunden in Millisekunden
			{
				
				Session::sessionDestroy();
				$_SESSION['timerDestroy']=time();
			 }
		}
	
	}
?>