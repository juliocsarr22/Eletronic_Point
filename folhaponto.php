<?php
  session_start();
  if(!isset($_SESSION['nome'])){
    header('Location: login.php');
  }

  require_once('php/controlador.php');
  $cont = new Controlador();
  // definições de host, database, usuário e senha
  $server = '127.0.0.1';
  $user = 'root';
  $password = '';
  $dbname = 'pontoeletronico';
  // conecta ao banco de dados
  $con = mysqli_connect($server, $user, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
  // seleciona a base de dados em que vamos trabalhar
  mysqli_select_db($con, 'pontoeletronico');
  // cria a instrução SQL que vai selecionar os dados
  $query = sprintf('SELECT * FROM folhaponto');
  // executa a query
  $dados = mysqli_query($con, $query) or die(mysqli_error($con));
  // transforma os dados em um array
  $linha = mysqli_fetch_assoc($dados);
  // calcula quantos dados retornaram
  $total = mysqli_num_rows($dados);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <?php require_once 'head.php'; ?>
  <meta charset="UTF-8">
    <style>
      body {
          padding-top: 70px;
          /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
      }

      .col-centered{
          float: none;
          margin: 0 auto;
      }

      .ordenavel{
        cursor: pointer;
      }
    
      
    </style>
  </head>

  <body class="fixed-nav" id="page-top">
  <?php require_once 'nav.php'; ?>

    <div class="content-wrapper py-3">
      <div class="container-fluid">
        <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Hora de Entrada</th>
                  <th scope="col">Hora de Saída</th>
                  <th scope="col">Data</th>
                  <th scope="col">Justificativa</th>
                </tr>
              </thead>
            <?php
                if($total > 0) {
                    do {
            ?>

              <tr>
                  <td><span class="ordenavel"><?=$linha['entrada']?></span></td>
                  <td><span class="ordenavel"><?=$linha['saida']?></span></td>
                  <td><span class="ordenavel"><?=$linha['data']?></span></td>
                  <td><span class="ordenavel"><?=$linha['descricao']?></span></td>
              </tr>
            <?php
                    // finaliza o loop que vai mostrar os dados
                    }while($linha = mysqli_fetch_assoc($dados));
                // fim do if 
                }

            ?>
          </table>
          </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
        </div>
    
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>