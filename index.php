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
          </div>

          <?php

            if(isset($_COOKIE['info']))
            {
              print($_COOKIE['info']);
              echo "<br><hr>";
              unset($_COOKIE['info']);
            }

          ?>

          <div class="row mb-3">


            <?php if($tipo == "supadmin") {?>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todas compras</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($compras); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-dark"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Nr. Reclamacoes</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($reclamacoes); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Ganho Geral</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($impostos); //FALTA SOMAR COM A CENA DAS SMSs ?> Mt</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Impostos pagos </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($impostos); ?> Mt</div>                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>


            <?php if($tipo == "admin") {?>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todas compras</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($compras); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-dark"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Nr. Reclamacoes</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($reclamacoes); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Ganho Geral</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($impostos); //FALTA SOMAR COM A CENA DAS SMSs ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Impostos pagos </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($impostos); ?> Mt</div>                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>


            <?php if($tipo == "entregador") {?>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todos pedidos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">22</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-dark"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Nr. Reclamacoes</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($reclamacoes); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Ganho Geral</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">3.629,00 Mt</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Classificação </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">4 Pontos</div>                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-star fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>



            <?php if($tipo == "distribuidor") {?>

            
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Produtos Expirados</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($reclamacoes); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Lista de entregas</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print($reclamacoes); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Afiliados de venda </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">32</div>                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>


            <!-- Invoice Example -->
            <div class="col-xl-8 col-lg-7 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">
                    <?php 
                    if($tipo == "admin" || $tipo == "supadmin") 
                    {  
                      print("Pedidos de aderencia ao Mercado (vendedores)");
                    } else if ($tipo == "distribuidor") {
                      print("Pedidos");
                    }
                    else if ($tipo == "entregador") {
                      print("Entregas");
                    }
                    ?>
                  </h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="#">Ver mais <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Item</th>
                        <th>Estado</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#">RA0449</a></td>
                        <td>Udin Wayang</td>
                        <td>Nasi Padang</td>
                        <td><span class="badge badge-success">Entregue</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA5324</a></td>
                        <td>Jaenab Bajigur</td>
                        <td>Gundam 90' Edition</td>
                        <td><span class="badge badge-warning">Acaminho</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA8568</a></td>
                        <td>Rivat Mahesa</td>
                        <td>Oblong T-Shirt</td>
                        <td><span class="badge badge-danger">Pendente</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA1453</a></td>
                        <td>Indri Junanda</td>
                        <td>Hat Rounded</td>
                        <td><span class="badge badge-info">Processando</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA1998</a></td>
                        <td>Udin Cilok</td>
                        <td>Baby Powder</td>
                        <td><span class="badge badge-success">Entregue</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>


            <?php if($tipo == "admin" || $tipo == "supadmin") {?>
            <!-- Message From Customer-->
            <div class="col-xl-4 col-lg-5 ">
              <div class="card">
                <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-light">Mensagens</h6>
                </div>
                <div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">Preciso de informacoes sobre o registro na plataforma para vendedores.</div>
                      <div class="small text-gray-500 message-time font-weight-bold">8275675156</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a href="#">
                      <div class="text-truncate message-title">Possibilidade de cobranca de taxas online
                      </div>
                      <div class="small text-gray-500 message-time">85575454654</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">Quais mercados vai abranger?
                      </div>
                      <div class="small text-gray-500 message-time font-weight-bold">841231244</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">Surpresas boas
                      </div>
                      <div class="small text-gray-500 message-time font-weight-bold">87565556 </div>
                    </a>
                  </div>
                  <div class="card-footer text-center">
                    <a class="m-0 small text-primary card-link" href="#">Ver todas <i
                        class="fas fa-chevron-right"></i></a>
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
        <?php include "footer.php"; ?>
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