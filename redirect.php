<?php
	require_once('conexao.php');
	
	ob_start();
	$vvUsuario = $_POST["username"];
	$vvSenha = $_POST["password"];
	session_start();
	if(strlen($vvUsuario) > 0){
		$vSQL = "SELECT u.*, r.role FROM usuario u INNER JOIN usuario_roles r ON u.id = r.id_usuario WHERE u.username = '".ltrim(rtrim($vvUsuario))."' AND u.enabled = 1";
		$result = mysql_query($vSQL);
		if($consulta = mysql_fetch_array($result)) {
			$vvUsuarioID  = $consulta[id];
			$vvSenhaBD    = $consulta[password];
			$vvNome       = $consulta[nome];
			$vRole        = $consulta[role];
			$vTipoUsuario = $consulta[tipo];
			if(strtoupper(ltrim(rtrim($vvSenha))) == strtoupper(ltrim(rtrim($vvSenhaBD)))){
				$_SESSION['idUsuario'] = $vvUsuarioID;
				$_SESSION['mensagem'] = "Bem-vindo $vvNome!";
				$_SESSION['role'] = $vRole;
				$_SESSION['nomeUsuario'] = $vvNome;
				$_SESSION['tipoUsuario'] = $vTipoUsuario;
				header("location:principal.php");
			}else{
				$_SESSION['erro'] = "Senha n&atilde;o confere.";
				header("location:index.php");
			}
		}else{
			$_SESSION['erro'] = "Usu&aacute;rio n&atilde;o cadastrado.";
			header("location:index.php");
		}
	}
	
?>