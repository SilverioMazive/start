<?php

 include "proc/permissao.php";

?>

<?php
  $instid = $_SESSION['instid'];
if(isset($_GET['delete'])){  
  $doutid = (int)str_replace(' ', '', intval($_GET['delete']));
  $estado = "desativado";
  
  $sqlme = "UPDATE tbdoutoramento SET estado='".$estado."' 
  where doutid=".$doutid." AND instid=".$instid;
  $resultme = mysqli_query($conn, $sqlme);
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Curso</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "header.php"?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <?php include "header2.php"?>
          </ul>
        </nav>
        <!-- Topbar -->
<!-- Invoice Example -->
<div class="col-xl-8 col-lg-7 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Lista de videos</h6>
        <?php

            if(isset($_SESSION['info']))
            {
              echo "<br><hr>";
              print($_SESSION['info']);
              echo "<br><hr>";
              unset($_SESSION['info']);
            }

          ?>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th>Nome</th>
              <th>Duração</th>    
              <th>Editar</th>
              <th>Apagar</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $estado = 'desativado';
              $sql = "SELECT * FROM tbdoutoramento where estado!='$estado' AND instid=".$_SESSION['instid']." ORDER BY doutid DESC";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo $row['nome'] ?></td>
              <td><?php echo $row['duracao'] ?></td>                          
              <td><a href="doutoramentoedit.php?id=<?php echo $row['doutid'] ?>" class="btn btn-sm btn-info"><i class="fa fa-penO teu namorado pode receber presentes da amiga?"> Editar</i></a></td>
              <td><a href="doutoramentoall.php?delete=<?php echo $row['doutid'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tens certeza que vais apagar este jornal?')"><i class="fa fa-trash-alt"> Apagar</i></a></td>
            </tr>
            <?php
                }

              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
        
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