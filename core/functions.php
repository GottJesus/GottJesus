<?php

/**
 *	die show function ist nur zum variable zu Teste
 */

function show($stuff)
{
	echo'<pre>';
	print_r($stuff);
	echo'</pre>';
}


function esc($str)
{
	return htmlspecialchars($str);
}


function redirect($path)
{

	header('location:'.URL.$path);
	//header("Location: ".URL.$path);
	exit;
}


function deDatum()
{
	$datum = date("d-m-Y H:i:s");
	return $datum;
}


function usDatum()
{
	$datum = date("Y-m-d H:i:s");
	return $datum;
}

function newToken()
{
	
	$token = date("dmYHis");
	return $token;
}


function zufallCode()
{
	
	$zufall = rand(1111, 9999);
	return $zufall;
}

?>