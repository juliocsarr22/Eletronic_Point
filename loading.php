<?php
	$server = '127.0.0.1';
  $user = 'root';
  $password = '';
  $dbname = 'pontoeletronico';
  // conecta ao banco de dados
  $con = mysqli_connect($server, $user, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
  // seleciona a base de dados em que vamos trabalhar
  mysqli_select_db($con, 'pontoeletronico');

$id = $_GET["id"];
$month = $_GET["month"];

if($_GET['type'] == 0){
	mysqli_query($con, "INSERT INTO folhaponto(entrada, data, usuario_idusuario, meses_idmes) VALUES (CURTIME(), CURDATE(), $id , $month)");
} else if($_GET['type'] == 1){
	mysqli_query($con, "UPDATE folhaponto SET saida = CURTIME(), hrs_trab = TIMEDIFF(saida, entrada) WHERE usuario_idusuario = $id AND saida = '00:00:00'");
}

header("Location: dashboard.php");

?>

<style type="text/css">
  body {
    background-image: url("img/jequiti.jpg");
  }
</style>
<body>
</body>
