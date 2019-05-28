<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="#">CONTROLE DE PONTO DOS BOLSISTAS DIÁRIO DE NATAL</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="dashboard.php">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">
                Inicio</span>
            </a>
          </li>
        <?php
          if(isset($_SESSION['tipo'])&&($_SESSION['tipo'] == 1)){ ?>
         <li class="nav-item" title="Cadastrar Bolsistas">
            <a class="nav-link" href="cadastro.php">
              <i class="fa fa-address-card-o"></i>
              <span class="nav-link-text">
                Cadastrar Bolsistas</span>
            </a>
         </li>
        <?php } ?>
        <?php
          if(isset($_SESSION['tipo'])&&($_SESSION['tipo'] == 1)){ ?>
         <li class="nav-item" title="Lista de Bolsistas">
            <a class="nav-link" href="listabolsistas.php">
              <i class="fa fa-address-card-o"></i>
              <span class="nav-link-text">
                Lista de Bolsistas</span>
            </a>
         </li>
         
         <?php } ?>
         <?php
          if(isset($_SESSION['tipo'])&&($_SESSION['tipo'] == 0)){ ?>
         <li class="nav-item" title="Folha de ponto">
            <a class="nav-link" href="folhaponto.php">
              <i class="fa fa-list-ul"></i>
              <span class="nav-link-text">
                Lista de frequencia</span>
            </a>
         </li>
         
         <?php } ?>
        </ul>
          
        
        <ul class="navbar-nav ml-auto">
           
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
            </form>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>
              Sair</a>
          </li>
        </ul>
      </div>
</nav>

