<?php
	// A sess�o precisa ser iniciada em cada p�gina diferente
	if (!isset($_SESSION)) session_start();	
	// Destr�i a sess�o por seguran�a
	session_destroy();	
	header("location: index.php"); 
?>