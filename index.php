<!DOCTYPE html>
<html
	lang="pt-br" 
	xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <title>Sistema de agendamento de consultas</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="layout/css/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="layout/css/ie10-viewport-bug-workaround.css"/>
  <link rel="stylesheet" type="text/css" href="layout/css/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="layout/css/form-elements.css"/>
  <link rel="stylesheet" type="text/css" href="layout/css/style.css"/>  
  
  <link rel="shortcut icon" href="layout/images/favicon.png">
  
  <script src="layout/js/bootstrap.js"></script>
	<script src="layout/js/ie-emulation-modes-warning.js"></script>
	<script src="layout/js/ie10-viewport-bug-workaround.js"></script>
	<script src="layout/js/jquery.backstretch.min.js"></script>
	<script src="layout/js/scripts.js"></script>	
  	
	<script type="text/javascript">
		function validateForm() {
		    var vLogin = document.getElementById("username").value;
			var vSenha = document.getElementById("password").value;
		    if(vLogin.length == 0){
			    alert("Usuario em branco. Verifique!");
			    return false;
		    }else{
				if(vSenha.length == 0){
					alert("Senha em branco. Verifique!");
				    return false;
				}else
					return true;				
			}
	    }
	</script>
	
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 <?php
	
	ob_start();
	session_start();
	$vvErro = $_SESSION["erro"];
	
	$vvMensagemErro = "";
	if(strlen($vvErro) > 0){
		$vvMensagemErro = "<div class='alert alert-danger' role='alert'>
		                     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							 	<span aria-hidden='true'>&times;</span>
							 </button>
							 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
							 <span class='sr-only'>Error ao fazer o Login:</span>&nbsp;$vvErro<br/>
						   </div>";
		$_SESSION["erro"] = "";
	}
?>
</head>
<body>
	<div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Sistema de agendamento de consultas</h3>
                            		<p>Digite seu Usu&aacute;rio e Senha:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<!-- <i class="fa fa-key"></i> -->
                        			<span class="glyphicon glyphicon-user"></span>                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="redirect.php" method="POST" class="login-form" onSubmit="return validateForm()">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Usu&aacute;rio</label>
			                        	<input type="text" name="username" id="username" placeholder="Usu&aacute;rio..." class="form-username form-control">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Senha</label>
			                        	<input type="password" name="password" placeholder="Senha..." class="form-password form-control" id="password">
			                        </div>
			                        <button type="submit" class="btn">Entrar!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                </div>
            </div>
            
        </div>
	<!--		
	<div class="alert alert-danger fade in alert-dismissible" th:if="${#bools.isTrue(param.error)}">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
	  <strong>Atenção!</strong> O usuário e/ou senha não conferem.
	</div>
	-->
	<?php
		if(strlen($vvMensagemErro) > 0) {
			echo($vvMensagemErro);
		}
	?>
	
</body>
</html>

</html>