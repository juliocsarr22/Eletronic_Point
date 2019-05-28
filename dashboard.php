<?php
session_start();
if(!isset($_SESSION['nome'])){
  header('Location: index.php');
}
require_once('bdd.php');

?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <?php
            include 'head.php';
        ?>
        <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
        <script type="text/javascript">
            jQuery(window).load(function($){
                atualizaRelogio();
            });
        </script>
    </head>

  <body class="fixed-nav" id="page-top">
    <?php
    include 'nav.php';
    ?>
    <div class="content-wrapper py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div>
                        <output id="data" style="font-family: 'arial black', 'avant garde'; font-size: 50px;"></output>
                    </div>
                    <div>
                        <output id="hora" style="font-family: 'arial black', 'avant garde'; font-size: 50px;"></output>             
                    </div> 
                    <button class="btn btn-primary" type="submit">Registrar</button><br>
                    <br>
                    <textarea rows="5" cols="80" maxlength="500" placeholder="Justificativa de atraso/adiantamento de horas"></textarea>
                </div> 
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>

  <script>
        function atualizaRelogio(){ 
            var momentoAtual = new Date();
            
            var vhora = momentoAtual.getHours();
            var vminuto = momentoAtual.getMinutes();
            var vsegundo = momentoAtual.getSeconds();
            
            var vdia = momentoAtual.getDate();
            var vmes = momentoAtual.getMonth() + 1;
            var vano = momentoAtual.getFullYear();
            
            if (vdia < 10){ vdia = "0" + vdia;}
            if (vmes < 10){ vmes = "0" + vmes;}
            if (vhora < 10){ vhora = "0" + vhora;}
            if (vminuto < 10){ vminuto = "0" + vminuto;}
            if (vsegundo < 10){ vsegundo = "0" + vsegundo;}
 
            dataFormat = vdia + " / " + vmes + " / " + vano;
            horaFormat = vhora + " : " + vminuto + " : " + vsegundo;
 
            document.getElementById("data").innerHTML = dataFormat;
            document.getElementById("hora").innerHTML = horaFormat;
 
            setTimeout("atualizaRelogio()",1000);
        }
    </script>   
</html>
