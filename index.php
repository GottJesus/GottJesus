<?php
	/*
	*	GottJesus
	*	1.04.2024
	*/

	session_start();
	// alle Konstanze , url, mysql
	require 'config.php';
	require 'util/Auth.php';
	
	// anbinden Haupt class	
	require 'core/functions.php';
	require 'core/Database.php';
	require 'core/Model.php';
	require 'core/View.php';	
	require 'core/Session.php';
	require 'core/Controller.php';
	require 'core/App.php';
	
	
	// autoloader, ladet alle nötige class aus den models Datei
	spl_autoload_register(function($class){
		require "models/".ucfirst($class).".php";
		//print_r($class.' -> die geladene scripten von models,  Quelle: index.php(Haupt)<br>');
	});
	

	DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0); 
	
	// Start App
	$app = new App();
	$app->loadController();

?>