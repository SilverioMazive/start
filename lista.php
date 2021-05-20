<?php

include "controller/permissao.php";

if (isset($_GET['id'])) {
  $palavraid = mysqli_real_escape_string($conn , $_GET['id']);
  if (is_numeric($palavraid)) {
    $query = "SELECT * FROM tbpalavras WHERE palavraid = '$palavraid' ";
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($run) > 0) {
      while ($row = mysqli_fetch_array($run)) {
         $palavraid = $row['palavraid'];
         $palavra = $row['palavra'];
         $level = $row['level'];
      }
    }
    else {
      echo "<script> alert('error');
      window.location.href = 'index.php'; </script>" ;
    }
  }
  else {
    header("location: index.php");
  }
}

if(isset($_POST['submit']) && $_POST['level'] != "none") {

  $palavra =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['palavra'])));
  $level = (int)str_replace(' ', '', intval($_POST['level']));
  $acertos = '0';
  $erros = '0';
          

  $dataSeca = new DateTime('now');
  $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
  $data = $dataSeca->format('Y-m-d H:i');  
      
  $query = "UPDATE tbpalavras SET palavra = '$palavra' , level = '$level' WHERE palavraid = '$palavraid' ";
  $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn) > 0 ) 
  {
    echo "<script>alert('Atualizada com sucesso!'); </script> " ;
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

$sqlnivel0 = "SELECT count(palavraid) as nivel0 FROM tbpalavras  WHERE level='0'";
$resultnivel0 = mysqli_query($conn, $sqlnivel0);
if (mysqli_num_rows($resultnivel0) > 0) {
    $rownivel0 = mysqli_fetch_assoc($resultnivel0);
    $nivel0 = $rownivel0['nivel0'];
}

$sqlnivel1 = "SELECT count(palavraid) as nivel1 FROM tbpalavras WHERE level='1'";
$resultnivel1 = mysqli_query($conn, $sqlnivel1);
if (mysqli_num_rows($resultnivel1) > 0) {
    $rownivel1 = mysqli_fetch_assoc($resultnivel1);
    $nivel1 = $rownivel1['nivel1'];
}

$sqlnivel2 = "SELECT count(palavraid) as nivel2 FROM tbpalavras WHERE level='2'";
$resultnivel2 = mysqli_query($conn, $sqlnivel2);
if (mysqli_num_rows($resultnivel2) > 0) {
    $rownivel2 = mysqli_fetch_assoc($resultnivel2);
    $nivel2 = $rownivel2['nivel2'];
}

$sqlnivel3 = "SELECT count(palavraid) as nivel3 FROM tbpalavras WHERE level='3'";
$resultnivel3 = mysqli_query($conn, $sqlnivel3);
if (mysqli_num_rows($resultnivel3) > 0) {
    $rownivel3 = mysqli_fetch_assoc($resultnivel3);
    $nivel3 = $rownivel3['nivel3'];
}

$sqlnivel4 = "SELECT count(palavraid) as nivel4 FROM tbpalavras WHERE level='4'";
$resultnivel4 = mysqli_query($conn, $sqlnivel4);
if (mysqli_num_rows($resultnivel4) > 0) {
    $rownivel4 = mysqli_fetch_assoc($resultnivel4);
    $nivel4 = $rownivel4['nivel4'];
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
  <title>Todas Palavra</title>
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
      
      <div class="col-xl-8 col-lg-7 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
         <thead class="thead-light">
            <tr>
              <th class="diminuirtexto">Nivel</th>  
              <th>Nr. de perguntas</th>  
            </tr>
          </thead>          
          <tbody>                   
            <tr>
              <td class="diminuirtexto">0</td>                        
              <td><?php echo $nivel0; ?></td>                                 
            </tr>         
            <tr>
              <td class="diminuirtexto">1</td>                        
              <td><?php echo $nivel1; ?></td>                                 
            </tr>    
            <tr>
              <td class="diminuirtexto">2</td>                        
              <td><?php echo $nivel2; ?></td>                                 
            </tr>    
            <tr>
              <td class="diminuirtexto">3</td>                        
              <td><?php echo $nivel3; ?></td>                                 
            </tr>    
            <tr>
              <td class="diminuirtexto">4</td>                        
              <td><?php echo $nivel4; ?></td>                                 
            </tr>       
          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
       
<!-- Container Fluid-->

  <div class="col-xl-8 col-lg-7 mb-4">
    
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      
        <h6 class="m-0 font-weight-bold text-primary">Todas Palavras</h6>
        <a class="m-0 float-right btn btn-danger btn-sm" href="editar.php">Ver Mais <i
            class="fas fa-chevron-right"></i></a>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th class="diminuirtexto">Palavra</th>  
              <th>Nivel</th>                        
              <th>Acertos</th>
              <th>Erros</th> 
              <th>Editar</th> 
            </tr>
          </thead>
          <tbody>
            <?php
              
           $sql2 = "SELECT * FROM tbpalavras order by palavraid desc limit 100";
          $result2 = mysqli_query($conn, $sql2);

          if(mysqli_num_rows($result2)){
            while($row2 = mysqli_fetch_assoc($result2))
            {
              $palavraid = $row2['palavraid'];
              $palavra = $row2['palavra'];
              $level = $row2['level'];
              $acertos = $row2['acertos'];     
              $erros = $row2['erros'];                        
            ?>
            <tr>
              <td class="diminuirtexto"><?php echo $palavra; ?></td>                        
              <td><?php echo $level; ?></td>
              <td><?php echo $acertos; ?></td>
              <td><?php echo $erros; ?></td>
              <td><a href="editarprocess.php?id=<?php echo $row2['palavraid'] ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"> Editar</i></a></td>                        
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