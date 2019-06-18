<?php
  session_start();
  if(!isset($_SESSION['nome'])){
    header('Location: login.php');
  }

  require_once('php/controlador.php');
  $cont = new Controlador();
  $server = '127.0.0.1';
  $user = 'root';
  $password = '';
  $dbname = 'pontoeletronico';

  // conecta ao banco de dados
  $con = mysqli_connect($server, $user, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
  // seleciona a base de dados em que vamos trabalhar
  mysqli_select_db($con, 'pontoeletronico');
  // cria a instrução SQL que vai selecionar os dados
  $id = $_GET["id"];
  $queryN = sprintf("SELECT nome FROM usuario WHERE idUsuario = $id");
  $dadosN = mysqli_query($con, $queryN) or die(mysqli_error($con));
  $linhaN = mysqli_fetch_assoc($dadosN); 

  if(!isset($_POST["mes"])){
    $query = sprintf("SELECT * FROM folhaponto WHERE usuario_idusuario = $id");
  } else {
    $mes = $_POST["mes"];
    $query = sprintf("SELECT * FROM folhaponto WHERE usuario_idusuario = $id AND meses_idmes = $mes");
  }
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
    <style>
      body{
          padding-top: 70px;
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
                <center><h4><?php echo $linhaN['nome'] ?><h4></center>
                <tr>
                  <th scope="col">Data</th>
                  <th scope="col">Hora de Entrada</th>
                  <th scope="col">Hora de Saída</th>
                  <th scope="col">Horas Trabalhadas</th>
                </tr>
              </thead>
            <?php
                if($total > 0) {
                    do {
            ?>
              <tr>
                  <?php 
                    $arrayData = explode("-",$linha['data']);
                    $arrayDay = $arrayData[2];
                    $arrayMonth = $arrayData[1];
                    $arrayYear = $arrayData[0];
                  ?>
                  <td><span class="ordenavel"><?php echo $arrayDay . "/" . $arrayMonth . "/" . $arrayYear?></span></td>
                  <?php 
                    $arrayData = explode(":",$linha['entrada']);
                    $arrayHour_e = $arrayData[0];
                    $arrayMinute_e = $arrayData[1];
                  ?>
                  <td><span class="ordenavel"><?php echo $arrayHour_e . ":" . $arrayMinute_e?></span></td>
                  <?php 
                    $arrayData = explode(":",$linha['saida']);
                    $arrayHour_s = $arrayData[0];
                    $arrayMinute_s = $arrayData[1];
                  ?>
                  <td><span class="ordenavel"><?php echo $arrayHour_s . ":" . $arrayMinute_s?></span></td>
                  <?php 
                    $arrayData = explode(":",$linha['hrs_trab']);
                    $arrayHour_t = $arrayData[0];
                    $arrayMinute_t = $arrayData[1];
                  ?>
                  <td><span class="ordenavel"><?php echo $arrayHour_t . ":" . $arrayMinute_t?></span></td>
              </tr>
            <?php
                    // finaliza o loop que vai mostrar os dados
                    }while($linha = mysqli_fetch_assoc($dados));
                // fim do if 
                }
            ?>
          </table>
          <div class="col-md-3">
              <form method="POST" enctype="multipart/form-data" action="folha-admin.php?id=<?php echo $id;?>" id = "form">
                      <select class="form-control" id="sel1" name = "mes">
                        <option selected value = "0">Mês Selecionado</option>
                        <?php $cont->listarMeses(); ?>
                      </select>
                      <br> 
                      <button class="btn btn-success" type="submit" id="btn">Pesquisar</button>
                      <?php
                      if(isset($_SESSION['tipo'])&&($_SESSION['tipo'] == 1)){ ?>
                        <button class="btn btn-primary" onclick="Imprimir()" id="btn">Imprimir</button>
                      <?php } ?>
                      
               </form>
          </div>
          <style type="text/css" media="print">
              #btn,#form{
                display:none;
              }
          </style>
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
  <script type="text/javascript">
    function Imprimir(){
      window.print();
    }
  </script>
</html>