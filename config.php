<?php
/**
 *	Den 1.04.2024
 */
 
	//$conf['show_php_errors'] = E_ALL & ~ E_DEPRECATED;
	error_reporting(E_ALL);

	define('APP_NAME', "Verwaltung von Gott Jesus" );	
	define('DEBUG', true);
	
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		
		define('URL', 'http://localhost:8888/gottjesus/');
		
		// Database localhost
		define('DB_TYPE', 'mysql');
		define('DB_HOST', 'localhost');
		define('DB_NAME', 'jesus');
		define('DB_USER', 'root');
		define('DB_PASS', 'root');
		define('DB_OPTI', [ PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
								PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE,
								PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
								PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
		
	} else{
		
		define('URL', 'http:// www.gottjesus.de/');
		
		// Datebase netcup
		define('DB_TYPE', 'mysql');
		define('DB_HOST', 'mysql2e0e.netcup.net');
		define('DB_NAME', 'k114655_login');
		define('DB_USER', 'k114655_login');
		define('DB_PASS', 'login12');
		define('DB_OPTI', [ PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
							PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE,
							PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
							PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
	}
								
		/*
		*	wenn mit konstante DB_OPTI gibst Probleme dann 
		*	in model als array ausführen
		*	nicht vergessen in database variable ändern
		*/
					
?>