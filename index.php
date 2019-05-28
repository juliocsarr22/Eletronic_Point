<?php
session_start();
require_once 'php/controlador.php';

$erro = false;
if(isset($_SESSION['nome'])){
  header('Location: dashboard.php');
}elseif(isset($_POST['usuario']) && isset($_POST['senha'])){
  $matricula = $_POST['usuario'];
  $senha = $_POST['senha'];
  
  $cont = new Controlador();
  $usuario = $cont->login($matricula, $senha);
  if($usuario){
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['tipo'] = $usuario['tipo'];
    header('Location: dashboard.php');
  }else{
    $erro = true;
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
        <h2 class="form-signin-heading logo text-center">Login</h2>
        <?php 
          if($erro){
            echo '<div class="alert alert-danger">matricula e senha incorretos ou conta inexistente!</div>';
          }
        ?>
        
        <label for="usuario" class="sr-only">Matricula</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Matricula" required autofocus><br>
        <label for="senha" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required><br>
          <input style="background-color: rgb(0, 225, 225); color:black" class="subscribe" value="Entrar" type="submit">       
          </form>
         </div>
       
      </div>
      </div>
    </div>

    </div>
  </div> <!-- /container -->
  
        </div>
      </div>
     
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>
