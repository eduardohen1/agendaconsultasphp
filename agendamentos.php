<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  	<meta charset="UTF-8"/>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1"/>

  	<title>Sistema de agendamento de consultas</title>
  	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->  
  
  	<script src="layout/js/jquery-2.1.1.min.js"></script>
  
  	<link rel="stylesheet" type="text/css" href="layout/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="layout/css/ie10-viewport-bug-workaround.css"/>
	<link rel="stylesheet" type="text/css" href="layout/css/navbar.css"/>
	<link rel="stylesheet" type="text/css" href="layout/css/bootstrap-datetimepicker.css"/>
    
  	<link rel="shortcut icon" href="layout/images/favicon.png">
	<script src="layout/js/moment-with-locales.js"></script>
	<script src="layout/js/bootstrap-datetimepicker.js"></script>
	<script src="layout/js/bootstrap.js"></script>
	<script src="layout/js/ie-emulation-modes-warning.js"></script>
	<script src="layout/js/ie10-viewport-bug-workaround.js"></script>	
	<script src="layout/js/popper.min.js"></script>	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>
<?php
	ob_start();
	session_start();
	require_once('conexao.php');	

	$vvIdUsuario   = $_SESSION['idUsuario'];
	$vvNomeUsuario = $_SESSION['nomeUsuario'];
	$vvTipoUsuario = $_SESSION['tipoUsuario'];
	$vvMensagem    = $_SESSION['mensagem'];
	if(strlen(ltrim(rtrim($vvMensagem))) > 0)
		$vvMensagem = "<strong>".$vvMensagem."</strong>";
	if(strlen($vvIdUsuario)==0){
		session_destroy();	
		header("location: index.php"); 
	}
?>
<body>
	<nav class="navbar navbar-default">
    	<div class="container-fluid">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
          		</button>
          		<a class="navbar-brand" href="principal"><img alt="Brand" src="layout/images/favicon.png"></a>
    			<a href="#" class="navbar-brand">Agendamento de consultas</a>
        	</div>
        	<div id="navbar" class="navbar-collapse collapse">
          		<ul class="nav navbar-nav">              
          			<li><a href="principal.php">Home</a></li>
					<li><a href="#" data-toggle="modal" data-target="#myModal">Marcar</a></li>
					<?php
					if($vvTipoUsuario == 0){
						echo("<li class='dropdown'>");
						echo("   <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Cadastros<span class='caret'></span></a>");
						echo("   <ul class='dropdown-menu'>");
						echo("      <li><a href='#' data-toggle='modal' data-target='#myModalUser'>Usu&aacute;rio</a></li>");
						echo("   </ul>");
						echo("</li>");
					}?>
					<li class="active"><a href="agendamentos.php">Meus agendamentos</a></li>
					<?php
					if($vvTipoUsuario == 0){
						echo("<li><a href='confirmar.php'>Confirmar agendamento</a></li>");
					}?>
          		</ul>
          		<ul class="nav navbar-nav navbar-right">
            		<li class="dropdown">
              			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo($vvNomeUsuario);?></a>
              			<ul class="dropdown-menu">                  
		  					<li><a href="logout.php">Sair do sistema</a></li>                
      					</ul>
    				</li>
  				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
 	</nav>	
	
	<div class="container">
		<div class="jumbotron">
	        <h2>Meus agendamentos</h2>
			<p>&nbsp;</p>
	        <p>
			<?php
				
				$vSQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') vDataAgenda, TIME_FORMAT(data,'%H:%i') vHoraAgenda FROM agendar WHERE id_usuario = $vvIdUsuario ORDER BY data DESC";
				$result = mysql_query($vSQL)or die('ER.Erro ao consultar agendamentos do usuario: '.mysql_error());
				$vI = 0;
				$vvResposta = "";				
				while($consulta = mysql_fetch_array($result)) {
					$vEspecialidade = mysql_result($result,$vI,"especialidade");
					$vData          = mysql_result($result,$vI,"vDataAgenda")." ".mysql_result($result,$vI,"vHoraAgenda");
					$vSituacao      = mysql_result($result,$vI,"situacao");
					$vvObservacao   = mysql_result($result,$vI,"observacao");
					$vvSituacao     = ""; //0 aberto 1 marcado 2 excluido
					switch($vSituacao){
						case 0:
							$vvSituacao = "<a href='javascript:alert(\"Solicitacao de agendamento em aberto\")' class='btn btn-warning'>&nbsp;<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>&nbsp;</a>";
							break;
						case 1:
							$vvSituacao = "<a href='javascript:alert(\"Agendado!\")' class='btn btn-success'>&nbsp;<span class='glyphicon glyphicon-check' aria-hidden='true'></span>&nbsp;</a>";
							break;
						case 2:		
							$vvSituacao = "<a href='javascript:alert(\"Solicitacao de agendamento nao efeturada! [".$vvObservacao."]\")' class='btn btn-danger'>&nbsp;<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;</a>";
							break;
					}
					$vvResposta .= "<tr>";				
					$vvResposta .= "<td class='text-center'>$vData</td>";
					$vvResposta .= "<td class='text-center'>$vEspecialidade</td>";
					$vvResposta .= "<td class='text-center'>$vvSituacao</td>";
					$vvResposta .= "</tr>";				
					$vI++;
				}
				
				if(strlen($vvResposta) ==0 ){
					$vvResposta = "<tr><td colspan=3>Nenhuma agenda cadastrada!</td></tr>";
				}
				
				$vTabela  = "<div class='table-responsive'>";
				$vTabela .= "<table class='table table-bordered table-striped'>";
				$vTabela .= "  <thead>";
				$vTabela .= "    <tr>";
				$vTabela .= "      <th class='text-center col-md-3'>Data do agendamento</th>";
				$vTabela .= "      <th class='text-center col-md-2'>Especialidade</th>";
				$vTabela .= "      <th class='text-center col-md-1'>Situa&ccedil;&atilde;o</th>";
				$vTabela .= "    </tr>";
				$vTabela .= "  </thead>";
				$vTabela .= "  <tbody id='tbListaAgenda'>";
				$vTabela .= $vvResposta;
				$vTabela .= "  </tbody>";
				$vTabela .= "</table>";
				$vTabela .= "</div>";
				echo($vTabela);							
			?>
			</p>
      	</div>

    </div>
		
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Marcar consulta</h4>
		  </div>
		  <form method="POST" class="form-vertical  js-form-loading" action="novo.php">
		  <div class="modal-body">
		  	
				<div class="form-group row">
	 		    	<label for="inputNome" class="col-sm-2 col-form-label">Especialidade:</label>
      				<div class="col-sm-10">
        				<select class='form-control' id='cboEspecialidade' name='cboEspecialidade'>
							<option value='Pediatra'>Pediatra</option>
							<option value='Gastro'>Gastro</option>
							<option value='Otorrino'>Otorrino</option>
							<option value='Geriatria'>Geriatria</option>
						</select>
						<input type='hidden' name='txtIdUsuario' id='txtIdUsuario' value="<?php echo($vvIdUsuario);?>" />
      				</div>
    			</div>
				<div class="form-group row">
	 		    	<label for="inputMotivo" class="col-sm-2 col-form-label">Data</label>
      				<div class="col-sm-10">
        				<div class="form-group">
			                <div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" name="txtData" id="txtData" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
      				</div>
    			</div>
		  </div>
		  <div class="modal-footer">
		  	<a class="btn btn-primary btn-lg" role="button" href="javascript:gravarNovoAgendamento();">Gravar</a>
			<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Fechar</button>			
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="myModalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabelUser">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Cadastrar novo usu&aacute;rio</h4>
		  </div>
		  <form method="POST" class="form-vertical  js-form-loading" action="novo.php">
		  <div class="modal-body">
		  		<div class="form-group row">
	 		    	<label for="inputLogin" class="col-sm-2 col-form-label">Nome:</label>
      				<div class="col-sm-10">
        				<input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" placeholder="Nome" maxlength="45" />
      				</div>
    			</div>
				<div class="form-group row">
	 		    	<label for="inputLogin" class="col-sm-2 col-form-label">Login:</label>
      				<div class="col-sm-10">
        				<input type="text" class="form-control" id="login" name="login" placeholder="Login" maxlength="20" />
      				</div>
    			</div>
				<div class="form-group row">
	 		    	<label for="inputLogin" class="col-sm-2 col-form-label">Senha:</label>
      				<div class="col-sm-10">
        				<input type="password" class="form-control" id="password" name="password" placeholder="Senha" maxlength="20" />
      				</div>
    			</div>
				<div class="form-group row">
	 		    	<label for="inputLogin" class="col-sm-2 col-form-label">Confirme a senha:</label>
      				<div class="col-sm-10">
        				<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirme a senha" maxlength="20" />
      				</div>
    			</div>
				<div class="form-group row">
	 		    	<label for="inputNome" class="col-sm-2 col-form-label">Tipo:</label>
      				<div class="col-sm-10">
        				<select class='form-control' id='cboTipo' name='cboTipo'>
							<option value='0'>Administrador</option>
							<option value='1'>Usu&aacute;rio</option>
						</select>
						<input type='hidden' name='txtIdUsuario' id='txtIdUsuario' value="<?php echo($vvIdUsuario);?>" />
      				</div>
    			</div>
		  </div>
		  <div class="modal-footer">
		  	<a class="btn btn-primary btn-lg" role="button" href="javascript:gravarNovoUsuario();">Gravar</a>
			<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Fechar</button>			
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function(){
		  //$("#lblContraChave").html(chave);
		  //$('#myInput').focus();		  
		});
		$('#myModalUser').on('shown.bs.modal', function(){
		  //$('#myInput').focus();		  
		});
		
		$(function(){
			$('#datetimepicker1').datetimepicker({ locale: 'pt-br'});
		});
		
		function gravarNovoUsuario(){
			var nomeUsuario = document.getElementById("nomeUsuario").value;
			var login       = document.getElementById("login").value;
			var senha       = document.getElementById("password").value;
			var senha2      = document.getElementById("password2").value;
			var tipo        = document.getElementById("cboTipo").value;
			var validou     = true;
			
			if(nomeUsuario.length == 0){
				alert('Digite o nome do usuario');
				validou = false;
			}
			if(login.length == 0 && validou){
				alert('Digite um login');
				validou = false;
			}
			if(senha.length == 0 && validou){
				alert('Digite uma senha');
				validou = false;
			}
			if(senha2.length == 0 && validou){
				alert('Digite a confiramacao da senha');
				validou = false;
			}
			if(senha != senha2 && validou){
				alert('A senha e sua validacao nao estao iguais! Verifique');
				validou = false;
			}
			if(tipo.length == 0 && validou){
				alert('Selecione um tipo de usuario');
				validou = false;
			}
			if(validou){
				var vData = novoUsuario(nomeUsuario, login, senha, tipo);
				var vMsg = vData.substring(0,3);
				vData = vData.substring(3, vData.lenght);
				if(vMsg == "ER.") {
					alert('Atencao!!!\nOcorreu um problema na execucao da funcao. Operacao sera cancelada!\nErr.: ' + vData);										
				}else{
					alert('Usuario cadastrado com sucesso!');
					$('#myModalUser').modal('hide');
				}
			}			
		}
		
		function gravarNovoAgendamento(){
			var especialidade = document.getElementById("cboEspecialidade").value;
			var data          = document.getElementById("txtData").value;
			var idUsuario     = document.getElementById("txtIdUsuario").value;
			
			var validou = true;
			
			//validação
			if(especialidade.length == 0){
				alert('Selecione a especialidade.');
				validou = false;
			}
			
			if(data.length == 0 && validou){
				alert('Indique a data');
				validou = false;				
			}
			
			if(validou){
				var vData = novoAgendamento(especialidade, data, idUsuario);
				var vMsg = vData.substring(0,3);
				vData = vData.substring(3, vData.lenght);
				if(vMsg == "ER.") {
					alert('Atencao!!!\nOcorreu um problema na execucao da funcao. Operacao sera cancelada!\nErr.: ' + vData);										
				}else{
					alert('Agendamento efeturado com sucesso!\nAguarde a confirmacao.');
					$('#myModal').modal('hide');
				}
			}/**/
		}//
		
		function novoAgendamento(especialidade, txtData, idUsuario){		
			var vTemp = "";
			var vTipo = 0;
			bodyContent = $.ajax({
				  url: "funcoes.php",
				  global: false,
				  type: "POST",
				  data: ({hTipo : vTipo, hEspecialidade : especialidade, hData : txtData, hIdUsuario : idUsuario}),
				  dataType: "html",
				  async:false,
				  success: function(msg){
					 return msg;
				  }
			   }
			).responseText;	//
			return bodyContent;		
		}
		
		function novoUsuario(nomeUsuario, login, senha, tipoUsuario){
			var vTipo = 1;
			bodyContent = $.ajax({
				  url: "funcoes.php",
				  global: false,
				  type: "POST",
				  data: ({hTipo : vTipo, hNomeUsuario : nomeUsuario, hLogin : login, hSenha : senha, hTipoUsuario : tipoUsuario}),
				  dataType: "html",
				  async:false,
				  success: function(msg){
					 return msg;
				  }
			   }
			).responseText;	//
			return bodyContent;
		}
		
	</script>
		
</body>
</html>