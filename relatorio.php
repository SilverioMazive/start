<?php

  include "controller/permissao.php";
  include "controller/geral.php";
  
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link href="img/logo/logo.png" rel="icon">-->
  <title>Inicio</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "header.php"; ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <?php include "header2.php"; ?>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 style="font-weight: bold; color: blue;">Imprimir documento</h2>
          </div>

          <?php

            if(isset($_SESSION['info']))
            {
              print($_SESSION['info']);
              echo "<br><hr>";
              unset($_SESSION['info']);
            }

          ?>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><!-- Pagar --></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center><a href="userprocess.php?id=1" class="btn btn-dark">Vendas</a> (10)</center></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><center><a href="userprocess.php?id=2" class="btn btn-warning">Levantamentos</a> (17)</center></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"></div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><center>
                        <?php if($tipo == "admin" || $tipo == "supadmin"){ ?>
                        <a href="userprocess.php?id=3" class="btn btn-info">Lista de pagamento de imposto</a> (4)</center></div>
                        <?php } else { ?>
                        <a href="userprocess.php?id=3" class="btn btn-info">Ultimo Recibo de imposto</a></center></div>
                        <?php } ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-truck fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"></div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><center><a href="userprocess.php?id=4" class="btn btn-success">Entregas</a> (4)</center></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shipping-fast fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php if($tipo == "supadmin") {?>

            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"></div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><center><a href="userprocess.php?id=4" class="btn btn-primary">Todos usuarios</a> (4)</center></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>


          <?php include "sair.php"; ?>
          

        </div>
        <!---Container Fluid-->
      </div>
          
      <!-- Footer -->
        <?php //include "footer.php"; ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>