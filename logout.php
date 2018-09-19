<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();	
	// Destrói a sessão por segurança
	session_destroy();	
	header("location: index.php"); 
?>