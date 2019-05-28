<?php
require_once 'php/controlador.php';
$erro = false;
$sucesso = false;

if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['matricula']) && isset($_POST['senha']) && isset($_POST['senha2']) && isset($_POST['tipo'])){
	if($_POST['senha'] != $_POST['senha2']){
		$erro = '<strong>ERRO!</strong> Senhas não coincidem.';
	}else{
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$matricula = $_POST['matricula'];
		$senha = $_POST['senha'];
		$tipo = $_POST['tipo'];
		
		$cont = new Controlador();
		if($cont->cadastrar($nome, $email, $matricula, $senha, $tipo)){
			header('Location: dashboard.php');
		}else{
			$erro = '<strong>ERRO!</strong> Sua matricula já foi cadastrada.';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ponto Eletrônico</title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <link href='https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,400italic,300italic,300|Raleway:300,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-index.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
		.subscribe_form .subscribe{
			width: 100%;
			border-bottom-left-radius: 30px;
			border-top-left-radius: 30px;
			top: 100%;
		}
		section{
			margin-top: 30px;
		}
		.subcription-info{
			margin-bottom:80px;
		}
		input.radio{
			background-color: red;
			height: 20px;
		}
	</style>
  </head>
  <body>
    <div class="content">
       <div class="container wow fadeInUp delay-03s">
        <div class="row">
          <div class="logo text-center">
			<h2 style="color: rgb(0, 225, 225)">Ponto Eletrônico dos bolsistas do Diário de Natal</h2>
          </div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-signin subscribe_form" method="POST">
					<h2 class="form-signin-heading logo text-center">Cadastro dos Bolsistas</h2>
					<?php if($erro){
						echo '<div class="alert alert-danger">' . $erro . '</div>';
					}elseif($sucesso){
						echo '<div class="alert alert-success">' . $sucesso . '</div>';
					}
					?>
					<label for="nome" class="sr-only">Nome</label>
					<input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required autofocus><br>
					<label for="email" class="sr-only">Email</label>
					<input type="text" id="email" name="email" class="form-control" placeholder="Email" required autofocus><br>
					<label for="email" class="sr-only">Matricula</label>
					<input type="text" id="matricula" name="matricula" class="form-control" placeholder="Matricula" required autofocus><br>
					<label for="senha" class="sr-only">Senha</label>
					<input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required><br>
					<label for="senha2" class="sr-only">Confirmar senha</label>
					<input type="password" id="senha2" name="senha2" class="form-control" placeholder="Confirmar senha" required><br>
					
					
					<div class="row">
						<div class="col-md-offset-2 col-md-4">
							<label for="Bolsista">
								<input class="radio" type="radio" name="tipo" id="Bolsista" value="0">Bolsista
							</label>
						</div>
						<div class="col-md-offset-2 col-md-4">
							<label for="Administrador">
								<input class="radio" type="radio" name="tipo" id="Administrador" value="1">Administrador	
							</label>
						</div>
					</div>
					
					<input style="background-color: rgb(0, 225, 225); color:black" class="subscribe" value="Cadastrar!" type="submit">
				</form>
			</div>
			 
		</div>
		</div>
	</div>
	  

     
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom.js"></script>
    
  </body>
</html>
