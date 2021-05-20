<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <!--<img src="img/logo/logo2.png">-->
        </div>
        <div class="sidebar-brand-text mx-3">Dream Seeder</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        <?php echo $nome ?>
      </div>

      <?php if ($tipo == "admin" || $tipo == "supadmin") { ?>
        <!-- ******************************************************************* -->
        <hr class="sidebar-divider">
        <li class="nav-item">
          <a class="nav-link" href="usuarios.php">
            <i class="fas fa-bag fa-sm fa-fw mr-2 text-gray-400"></i>
            <span class=""><b>Usuarios</b> <i class="fas fa-fw fa-users"></i></span>
          </a>
        </li>
        <!-- ******************************************************************* -->
      <?php } ?>

     <?php if ($tipo == "distribuidor") { ?>
        <!-- ******************************************************************* -->
        
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJornal" aria-expanded="true"
          aria-controls="collapseJornal">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Produtos</span>
        </a>
        <div id="collapseJornal" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">*******</h6>
            <a class="collapse-item" href="adicionar.php">Adicionar Produto</a>
            <a class="collapse-item" href="editar.php">Todos / Apagar</a>
          </div>
        </div>
      </li>
        <hr class="sidebar-divider">
        <li class="nav-item">
          <a class="nav-link" href="pedidos.php">
            <i class="fas fa-bag fa-sm fa-fw mr-2 text-gray-400"></i>
            <!-- <span class=""><b>Pedidos </b> <i class="fas fa-fw fa-users"></i> (<b style="color: red;">5</b>)</span> -->
            <span class=""><b>Vendas </b> <i class="fas fa-fw fa-users"></i></span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="impostos.php">
          <i class="fas fa-coins fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Pagar impostos</span>
        </a>
      </li>
        <!-- ******************************************************************* -->
      <?php } ?>

      <?php if ($tipo == "entregador") { ?>
        <!-- ******************************************************************* -->
        <hr class="sidebar-divider">
        <li class="nav-item">
          <a class="nav-link" href="entregas.php">
            <i class="fas fa-bag fa-sm fa-fw mr-2 text-gray-400"></i>
            <span class=""><b>Entregas </b> <i class="fas fa-fw fa-users"></i> (<b style="color: red;">5</b>)</span>
          </a>
        </li>
        <!-- ******************************************************************* -->
      <?php } ?>

      <hr class="sidebar-divider"> 
        <li class="nav-item">
          <a class="nav-link" href="reclamacoes.php">
            <i class="fas fa-bag fa-sm fa-fw mr-2 text-gray-400"></i>
            <span class=""><b>Mensagens </b> <i class="fas fa-fw fa-users"></i></span>
          </a>
        </li>
        <hr class="sidebar-divider"> 
        <li class="nav-item">
          <a class="nav-link" href="relatorio.php">
            <i class="fas fa-bag fa-sm fa-fw mr-2 text-gray-400"></i>
            <span class=""><b>Relatórios  </b> <i class="fas fa-fw fa-users"></i></span>
          </a>
        </li>
      <hr class="sidebar-divider"> 

      <?php if ($tipo != "admin" && $tipo != "supadmin") { ?>
       <li class="nav-item">
        <a class="nav-link" href="levantamento.php">
          <span class="btn btn-info btn-sm">Levantamentos <i style="color: rgb(177, 14, 14);" class="fas fa-fw fa-play-circle"></i></span>
        </a>
      </li>

      <hr class="sidebar-divider">
        <li class="nav-item">
          <a class="nav-link" href="qrcodeapp.php">
            <i class="fas fa-bag fa-sm fa-fw mr-2 text-gray-400"></i>
            <span class=""><b>Codigo de venda</b> <i class="fas fa-fw fa-qrcode"></i></span>
          </a>
        </li>
      <hr class="sidebar-divider"> 
      <?php } else if($tipo == "supadmin") { ?>
      <li class="nav-item">
        <a class="nav-link" href="levantamentos.php">
          <span class="btn btn-success btn-sm">Lista de levantamentos </span>
        </a>
      </li>
      <hr class="sidebar-divider"> 
      <?php } ?>



      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGes" aria-expanded="true"
          aria-controls="collapseGes">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Configurações</span>
        </a>
        <div id="collapseGes" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">*******</h6>
            <a class="collapse-item" href="configurar.php">Codigo de venda</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="alterarsenha.php">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Alterar Senha</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <span class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Sair</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>