<?php
/**
 *	Den 1.04.2024
 */
 
 class User {
	 
	use Model;
    
    protected $table = "user";
    protected $allowedColumns = [
        'datum',
        'letztelogin',
        'cookie',
        'login',
        'password',
        'passrecovery',
        'role',
        'other',
    ];
	 
	 
 }
?>