<?php
	ob_start();
	session_start();
	require_once('conexao.php');	
	
	$vvTipo = $_POST["hTipo"];	
	switch($vvTipo){
		case 0:
			//cadastrar agenda
			$vvIdUsuario     = $_POST["hIdUsuario"];
			$vvEspecialidade = $_POST["hEspecialidade"];
			$vvData          = $_POST["hData"];
			
			$vvData = rtrim(ltrim($vvData));
			$vvDatas = split(' ', $vvData);
			$vvDatas[0] = substr($vvDatas[0],6,4).'-'.substr($vvDatas[0],3,2).'-'.substr($vvDatas[0],0,2);
			
			$vSQL = "INSERT INTO agendar(especialidade, data, id_usuario) VALUES('$vvEspecialidade', '".$vvDatas[0]." ".$vvDatas[1]."',$vvIdUsuario)";
			mysql_query($vSQL) or die('ER.Erro ao agendar consulta: '.mysql_error());			
			echo("OK.Agendamento efetuado");			
			break;
		case 1:
			//cadastrar usuario
			 $vvNomeUsuairo = $_POST["hNomeUsuario"];
			 $vvLogin       = $_POST["hLogin"];
			 $vvSenha       = $_POST["hSenha"];
			 $vvTipoUsuario = $_POST["hTipoUsuario"];
			 
			 $vSQL = "INSERT INTO usuario(nome, username, password, tipo, dica, email, enabled) VALUES('$vvNomeUsuario', '$vvLogin', '$vvSenha', $vvTipoUsuario, '', '', 1)";
			 mysql_query($vSQL) or die('ER.Erro ao cadastrar usuario: '.mysql_error());			
			echo("OK.Cadastro usuario");
			break;
		case 2:
			//atualizar situacao
			$vvIdAgenda = $_POST["hIdAgenda"];
			$vvSituacao = $_POST["hSituacao"];
			$vvObservacao = $_POST["hObservacao"];
			
			$vSQL = "UPDATE agendar SET situacao = $vvSituacao, observacao = '".$vvObservacao."' WHERE id = $vvIdAgenda";
			mysql_query($vSQL) or die('ER.Erro ao atualizar agenda: '.mysql_error());
			switch($vvSituacao){
				case 0:
					$vSituacao = "<a href='#' class='btn btn-warning'>&nbsp;<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>&nbsp;</a>";
					break;
				case 1:
					$vSituacao = "<a href='#' class='btn btn-success'>&nbsp;<span class='glyphicon glyphicon-check' aria-hidden='true'></span>&nbsp;</a>";
					break;
				case 2:		
					$vSituacao = "<a href='#' class='btn btn-danger'>&nbsp;<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;</a>";
					break;
			}
			echo("OK.$vSituacao");			
			break;
	}
	
?>