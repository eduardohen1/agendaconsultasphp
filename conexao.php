<?php
	ini_set('display_errors', true);
	
	$host  = "localhost";
	$login = "root";
	$senha = "";
	$banco = "agendaconsulta";
	
	$cConexao = mysql_connect($host,$login,$senha) or die ("N�o foi poss�vel realizar a conex�o com o servidor!!!");   
   	$db_gestcom = mysql_select_db($banco,$cConexao) or die ("N�o foi poss�vel selecionar o banco de dados!!!");
	
?>