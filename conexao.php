<?php
	ini_set('display_errors', true);
	
	$host  = "localhost";
	$login = "root";
	$senha = "";
	$banco = "agendaconsulta";
	
	$cConexao = mysql_connect($host,$login,$senha) or die ("Não foi possível realizar a conexão com o servidor!!!");   
   	$db_gestcom = mysql_select_db($banco,$cConexao) or die ("Não foi possível selecionar o banco de dados!!!");
	
?>