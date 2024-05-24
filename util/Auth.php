<?php
class Auth
	{
		public static function handleLogin()
		{
			$logged = isset($_COOKIE['loggedIn']) ?? $_COOKIE['loggedIn'];			
			if(!$logged)
			{
				header('location:'.URL.'login');
				exit;
			}
		}
	}
?>