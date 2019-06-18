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
  $query = sprintf('SELECT * FROM usuario WHERE tipo = 0');
  // executa a query
  $dados = mysqli_query($con, $query) or die(mysqli_error($con));
  // transforma os dados em um array
  $linha = mysqli_fetch_assoc($dados);
  // calcula quantos dados retornaram
  $total = mysqli_num_rows($dados);
  if(isset($_SESSION['tipo'])&&($_SESSION['tipo'] == 0)){
    header("Location: index.php");
  } 
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <?php require_once 'head.php'; ?>
  <meta charset="UTF-8">
      
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
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Matricula</th>
                  <th scope="col">Remover</th>
                  <th scope="col">Folha de Ponto</th>
                </tr>
              </thead>
            <?php
                if($total > 0) {
                    do {
            ?>

              <tr>
                  <td><span class="ordenavel"><?=$linha['nome']?></span></td>
                  <td><span class="ordenavel"><?=$linha['matricula']?></span></td>
                  <td><form method="post"><button type="submit" class="btn btn-danger"><input type="hidden" name="excluir" value="<?= $linha["idUsuario"] ?>"></button></form></td>
                  <td><a href="folha-admin.php?id=<?php echo $linha['idUsuario'];?>" class="btn btn-success" type ="input" ></a></td>
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
        <?php
            if(isset($_POST['excluir']) && filter_input(INPUT_POST, 'excluir', FILTER_VALIDATE_INT) !== false){
              $id = mysqli_real_escape_string($con, $_POST['excluir']);
              $sql2 = "DELETE FROM usuario WHERE idUsuario='$id'";
              $qry2 = mysqli_query($con,$sql2);
            }
        ?>
        <!-- /.row -->
    </div>
    <!-- /.container -->
        </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>