<?php

include "controller/permissao.php";

  $query2 = "SELECT * FROM tbpalavrasconf WHERE pconfid = '1' ";
  $run2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
  if (mysqli_num_rows($run2) > 0) {
    while ($row2 = mysqli_fetch_array($run2)) {
       $temponormal = $row2['temponormal'];
       $tempoacelerado = $row2['tempoacelerado'];
       $chancenormal = $row2['chancenormal'];
       $chanceacelerada = $row2['chanceacelerada'];
       // $numerodeerrosnormal = $row2['numerodeerrosnormal'];
       // $numerodeerrosacelerado = $row2['numerodeerrosacelerado'];
    }
  }
  else {
    echo "<script> alert('error');
    window.location.href = 'index.php'; </script>" ;
  }
  


if(isset($_POST['submit'])) {

  $temponormal =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['temponormal'])));
  $tempoacelerado =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['tempoacelerado'])));
  $chancenormal =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['chancenormal'])));
  $chanceacelerada =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['chanceacelerada'])));
  // $numerodeerrosnormal =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['numerodeerrosnormal'])));
  // $numerodeerrosacelerado =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['numerodeerrosacelerado'])));
          
  $dataSeca = new DateTime('now');
  $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
  $data = $dataSeca->format('Y-m-d H:i');  
      
  // $query = "UPDATE tbpalavrasconf SET temponormal = '$temponormal' , tempoacelerado = '$tempoacelerado', chancenormal = '$chancenormal', chanceacelerada = '$chanceacelerada', numerodeerrosnormal = '$numerodeerrosnormal', numerodeerrosacelerado = '$numerodeerrosacelerado' WHERE pconfid = '1' ";
  $query = "UPDATE tbpalavrasconf SET temponormal = '$temponormal' , tempoacelerado = '$tempoacelerado', chancenormal = '$chancenormal', chanceacelerada = '$chanceacelerada' WHERE pconfid = '1' ";
  $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn) > 0) 
  {
    $_SESSION['info'] = 'Configurado com sucesso!';
    header("location: index.php");
    //$inserida = 'Atualizada com sucesso!';
  }
  else {
      "<script>alert('Erro, tente novamente!');</script>";
  }
}
else
{
  "<script>alert('Selecione um nivel!');</script>";
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
  <title>Configurar</title>
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
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Configurações</h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <label for="exampleInputEmail1">Tempo Normal </label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="temponormal" aria-describedby="emailHelp"
                  placeholder="Tempo em segundos" value="<?php echo($temponormal); ?>">                
              </div>              
              <br>
              <div class="form-group">
                <label for="exampleInputEmail1">Tempo Acelerado</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="tempoacelerado" aria-describedby="emailHelp"
                  placeholder="Tempo em segundos" value="<?php echo($tempoacelerado); ?>">                
              </div>              
              <br>
              <div class="form-group">
                <label for="exampleInputEmail1">Nr de Chances Normal</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="chancenormal" aria-describedby="emailHelp"
                  placeholder="Chances" value="<?php echo($chancenormal); ?>">                
              </div>              
              <br>
              <div class="form-group">
                <label for="exampleInputEmail1">Nr de Chances Acelerado</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="chanceacelerada" aria-describedby="emailHelp"
                  placeholder="Chances" value="<?php echo($chanceacelerada); ?>">                
              </div>              
              <br>
              

              <input type="submit" name="submit" class="btn btn-primary" value="Confirmar">
            </form>
          </div>
        </div>

      </div>

      
    </div>
    <?php include "sair.php"; ?>

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