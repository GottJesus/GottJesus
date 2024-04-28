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


?>